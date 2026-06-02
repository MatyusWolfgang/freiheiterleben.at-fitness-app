<?php

require_once __DIR__ . '/../../src/services/WorkoutService.php';
require_once __DIR__ . '/../../src/http/Response.php';
require_once __DIR__ . '/../../src/http/Validator.php';

class WorkoutController
{
    private WorkoutService $service;

    public function __construct()
    {
        $this->service = new WorkoutService();
    }

    public function getAll(): void
    {
        Response::success($this->service->getAll());
    }

    public function getById(int $id): void
    {
        $data = $this->service->getById($id);

        if (!$data) {
            Response::error("Workout not found", 404);
        }

        Response::success($data);
    }

    public function create(): void
    {
        $input = json_decode(file_get_contents("php://input"), true);

        $validator = new Validator();
        $validator->required($input, 'name');
        $validator->string($input, 'name');

        if ($validator->fails()) {
            Response::error("Validation failed", 422, $validator->errors());
        }

        $this->service->create($input);

        Response::success(["message" => "Workout created"], 201);
    }

    public function update(int $id): void
    {
        $input = json_decode(file_get_contents("php://input"), true);

        $validator = new Validator();
        $validator->required($input, 'name');
        $validator->string($input, 'name');

        if ($validator->fails()) {
            Response::error("Validation failed", 422, $validator->errors());
        }

        $updated = $this->service->update($id, $input);

        if (!$updated) {
            Response::error("Workout not found", 404);
        }

        Response::success(["message" => "Workout updated"]);
    }

    public function delete(int $id): void
    {
        $deleted = $this->service->delete($id);

        if (!$deleted) {
            Response::error("Workout not found", 404);
        }

        Response::success(["message" => "Workout deleted"]);
    }
}