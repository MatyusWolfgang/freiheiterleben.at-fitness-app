<?php

require_once __DIR__ . '/../../src/services/ExerciseService.php';
require_once __DIR__ . '/../../src/http/Response.php';

class ExerciseController
{
    private ExerciseService $service;

    public function __construct()
    {
        $this->service = new ExerciseService();
    }

    public function getAll(): void
    {
        $data = $this->service->getAllExercises();

        Response::success($data);
    }

    public function getById(int $id): void
    {
        try {
            $data = $this->service->getExerciseById($id);

            if (!$data) {
                Response::error("Exercise not found", 404);
            }

            Response::success($data);

        } catch (Exception $e) {
            Response::error($e->getMessage(), 500);
        }
    }

    public function create(): void
    {
        $input = json_decode(file_get_contents("php://input"), true);

        try {
            $this->service->createExercise($input);

            Response::success(
                ["message" => "Exercise created"],
                201
            );

        } catch (Exception $e) {

            Response::error(
                $e->getMessage(),
                400
            );
        }
    }
}