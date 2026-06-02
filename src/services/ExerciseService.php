<?php

require_once __DIR__ . '/../repositories/ExerciseRepository.php';

class ExerciseService
{
    private ExerciseRepository $repository;

    public function __construct()
    {
        $this->repository = new ExerciseRepository();
    }

    /**
     * Liefert alle Übungen
     */
    public function getAllExercises(): array
    {
        return $this->repository->findAll();
    }

    public function getExerciseById(int $id): ?array
    {
        return $this->repository->findById($id);
    }

    /**
     * Erstellt eine neue Übung
     */
    public function createExercise(array $data): void
    {
        // Minimal-Validierung (bewusst schlank halten)
        if (empty($data['name'])) {
            throw new InvalidArgumentException("Name ist required");
        }

        if (empty($data['type'])) {
            throw new InvalidArgumentException("Type ist required");
        }

        if (!isset($data['calories_factor'])) {
            $data['calories_factor'] = 1.0;
        }

        $this->repository->create(
            $data['name'],
            $data['type'],
            (float)$data['calories_factor']
        );
    }
}