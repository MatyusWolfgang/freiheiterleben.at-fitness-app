<?php

require_once __DIR__ . '/../repositories/WorkoutExerciseRepository.php';

class WorkoutExerciseService
{
    private WorkoutExerciseRepository $repo;

    public function __construct(
        ?WorkoutExerciseRepository $repo = null
    ) {
        $this->repo = $repo ?? new WorkoutExerciseRepository();
    }

    public function addToWorkout(array $data): void
    {
        $this->repo->create($data);
    }
}