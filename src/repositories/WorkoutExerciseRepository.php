<?php

require_once __DIR__ . '/../../config/database.php';

class WorkoutExerciseRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function findByWorkoutId(int $workoutId): array
    {
        $stmt = $this->db->prepare("
            SELECT 
                e.id,
                e.name,
                we.sets,
                we.reps,
                we.duration_seconds
            FROM workout_exercises we
            JOIN exercises e ON e.id = we.exercise_id
            WHERE we.workout_id = :workout_id
        ");

        $stmt->execute([
            'workout_id' => $workoutId
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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