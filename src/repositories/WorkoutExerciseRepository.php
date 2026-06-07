<?php

require_once __DIR__ . '/../../config/database.php';

class WorkoutExerciseRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function create(array $data): void
    {
        $stmt = $this->db->prepare("
            INSERT INTO workout_exercises
            (
                workout_id,
                exercise_id,
                sets,
                reps,
                duration_seconds
            )
            VALUES
            (
                :workout_id,
                :exercise_id,
                :sets,
                :reps,
                :duration_seconds
            )
        ");

        $stmt->execute([
            'workout_id' => $data['workout_id'],
            'exercise_id' => $data['exercise_id'],
            'sets' => $data['sets'],
            'reps' => $data['reps'],
            'duration_seconds' => $data['duration_seconds']
        ]);
    }
}