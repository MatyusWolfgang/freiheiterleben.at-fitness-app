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

        $validator = new Validator();

        $validator->required($input, 'name');
        $validator->required($input, 'type');
        $validator->required($input, 'calories_factor');

        $validator->string($input, 'name');
        $validator->string($input, 'type');
        $validator->numeric($input, 'calories_factor');

        if ($validator->fails()) {
            Response::error("Validation failed", 422, $validator->errors());
        }

        try {
            $this->service->createExercise($input);

            Response::success(["message" => "Exercise created"], 201);

        } catch (Exception $e) {
            Response::error($e->getMessage(), 500);
        }
    }

    public function update(int $id): void
    {
        $input = json_decode(file_get_contents("php://input"), true);

        $validator = new Validator();

        if (isset($input['name'])) {
            $validator->string($input, 'name');
        }

        if (isset($input['type'])) {
            $validator->string($input, 'type');
        }

        if (isset($input['calories_factor'])) {
            $validator->numeric($input, 'calories_factor');
        }

        if ($validator->fails()) {
            Response::error("Validation failed", 422, $validator->errors());
        }

        try {
            $updated = $this->service->updateExercise($id, $input);

            if (!$updated) {
                Response::error("Exercise not found", 404);
            }

            Response::success(["message" => "Exercise updated"]);

        } catch (Exception $e) {
            Response::error($e->getMessage(), 400);
        }
    }

    public function delete(int $id): void
    {
        try {
            $deleted = $this->service->deleteExercise($id);

            if (!$deleted) {
                Response::error("Exercise not found", 404);
            }

            Response::success(["message" => "Exercise deleted"]);

        } catch (Exception $e) {
            Response::error($e->getMessage(), 500);
        }
    }
    
}