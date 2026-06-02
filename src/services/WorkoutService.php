<?php

require_once __DIR__ . '/../repositories/WorkoutRepository.php';

class WorkoutService
{
    private WorkoutRepository $repo;

    public function __construct()
    {
        $this->repo = new WorkoutRepository();
    }

    public function getAll(): array
    {
        return $this->repo->findAll();
    }

    public function getById(int $id): ?array
    {
        return $this->repo->findById($id);
    }

    public function create(array $data): void
    {
        $this->repo->create($data['name']);
    }

    public function update(int $id, array $data): bool
    {
        return $this->repo->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->repo->delete($id);
    }
}