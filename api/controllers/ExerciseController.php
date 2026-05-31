<?php

require_once __DIR__ . '/../../src/services/ExerciseService.php';

class ExerciseController
{
    private ExerciseService $service;

    public function __construct()
    {
        $this->service = new ExerciseService();
    }

    public function getAll(): void
    {
        echo json_encode(
            $this->service->getAllExercises()
        );
    }

    public function create(): void
    {
        $input = json_decode(file_get_contents("php://input"), true);

        try {
            $this->service->createExercise($input);

            echo json_encode([
                "status" => "created"
            ]);

        } catch (Exception $e) {

            http_response_code(400);

            echo json_encode([
                "error" => $e->getMessage()
            ]);
        }
    }
}