<?php

require_once __DIR__ . '/../../config/database.php';

class ExerciseRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function findAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM exercises");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(string $name, string $type, float $factor): void
    {
        $stmt = $this->db->prepare("
            INSERT INTO exercises (name, type, calories_factor)
            VALUES (:name, :type, :factor)
        ");

        $stmt->execute([
            'name' => $name,
            'type' => $type,
            'factor' => $factor
        ]);
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare("
            SELECT * FROM exercises WHERE id = :id
        ");

        $stmt->execute(['id' => $id]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ?: null;
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("
            UPDATE exercises
            SET name = :name,
                type = :type,
                calories_factor = :factor
            WHERE id = :id
        ");

        return $stmt->execute([
            'id' => $id,
            'name' => $data['name'],
            'type' => $data['type'],
            'factor' => $data['calories_factor']
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("
            DELETE FROM exercises WHERE id = :id
        ");

        return $stmt->execute(['id' => $id]);
    }

}