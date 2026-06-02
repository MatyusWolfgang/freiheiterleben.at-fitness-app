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

}