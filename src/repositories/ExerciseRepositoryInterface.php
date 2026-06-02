<?php

interface ExerciseRepositoryInterface
{
    public function findAll(): array;

    public function findById(int $id): ?array;

    public function create(string $name, string $type, float $factor): void;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}