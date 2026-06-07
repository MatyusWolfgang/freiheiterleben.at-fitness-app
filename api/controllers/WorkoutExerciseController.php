<?php

require_once __DIR__ . '/../../src/services/WorkoutExerciseService.php';

class WorkoutExerciseController
{
    private WorkoutExerciseService $service;

    public function __construct()
    {
        $this->service = new WorkoutExerciseService();
    }

    public function create(int $workoutId): void
    {
        $input = json_decode(
            file_get_contents("php://input"),
            true
        );

        $this->service->addToWorkout([
            'workout_id' => $workoutId,
            'exercise_id' => $input['exercise_id'],
            'sets' => $input['sets'] ?? null,
            'reps' => $input['reps'] ?? null,
            'duration_seconds' => $input['duration_seconds'] ?? null,
        ]);

        echo json_encode([
            "status" => "created"
        ]);
    }
}