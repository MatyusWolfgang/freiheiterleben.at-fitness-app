<?php

require_once __DIR__ . '/../../../src/services/ExerciseService.php';
require_once __DIR__ . '/../../../src/repositories/ExerciseRepository.php';

use PHPUnit\Framework\TestCase;

class FakeExerciseRepository implements ExerciseRepositoryInterface
{
    public function findAll(): array
    {
        return [
            ['id' => 1, 'name' => 'Pushups']
        ];
    }

    public function findById(int $id): ?array
    {
        return ['id' => $id];
    }

    public function create(string $name, string $type, float $factor): void
    {
        // no-op for test
    }

    public function update(int $id, array $data): bool
    {
        return true;
    }

    public function delete(int $id): bool
    {
        return true;
    }
}