<?php

use PHPUnit\Framework\TestCase;

class DatabaseSchemaTest extends TestCase
{
    private PDO $pdo;

    protected function setUp(): void
    {
        $this->pdo = new PDO(
            "pgsql:host=postgres;dbname=fitness",
            "fitness_user",
            "secret",
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
    }

    public function testExercisesTableExists(): void
    {
        $stmt = $this->pdo->query("
            SELECT to_regclass('public.exercises') AS table_name
        ");

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertEquals(
            'exercises',
            $result['table_name']
        );
    }

    public function testWorkoutsTableExists(): void
    {
        $stmt = $this->pdo->query("
            SELECT to_regclass('public.workouts') AS table_name
        ");

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertEquals(
            'workouts',
            $result['table_name']
        );
    }

    public function testWorkoutExercisesTableExists(): void
    {
        $stmt = $this->pdo->query("
            SELECT to_regclass('public.workout_exercises') AS table_name
        ");

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertEquals(
            'workout_exercises',
            $result['table_name']
        );
    }
}