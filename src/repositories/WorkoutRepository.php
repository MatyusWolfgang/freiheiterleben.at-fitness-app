<?php

require_once __DIR__ . '/../../config/database.php';

class WorkoutRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function findAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM workouts ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM workouts WHERE id = :id");
        $stmt->execute(['id' => $id]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function create(string $name): void
    {
        $stmt = $this->db->prepare("
            INSERT INTO workouts (name)
            VALUES (:name)
        ");

        $stmt->execute(['name' => $name]);
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("
            UPDATE workouts
            SET name = :name
            WHERE id = :id
        ");

        return $stmt->execute([
            'id' => $id,
            'name' => $data['name']
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("
            DELETE FROM workouts WHERE id = :id
        ");

        return $stmt->execute(['id' => $id]);
    }
}