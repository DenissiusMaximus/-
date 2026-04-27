<?php

namespace Repositories;

use DataAccess\DbContext;
use Models\Source;
use Repositories\Interfaces\ISourceRepository;
use PDO;

class SourceRepository implements ISourceRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = DbContext::getConnection();
    }

    public function findAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM sources");
        $rows = $stmt->fetchAll();

        return array_map(fn($row) => new Source(
            $row['user_id'],
            $row['name'],
            $row['balance'],
            $row['id']
        ), $rows);
    }

    public function findById(int $id): ?Source
    {
        $stmt = $this->db->prepare("SELECT * FROM sources WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        if (!$row) return null;

        return new Source($row['user_id'], $row['name'], $row['balance'], $row['id']);
    }

    public function findByUserId(int $userId): array
    {
        $stmt = $this->db->prepare("SELECT * FROM sources WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        $rows = $stmt->fetchAll();

        return array_map(fn($row) => new Source(
            $row['user_id'],
            $row['name'],
            $row['balance'],
            $row['id']
        ), $rows);
    }

    public function create(Source $source): int
    {
        $stmt = $this->db->prepare(
            "INSERT INTO sources (user_id, name, balance) VALUES (:user_id, :name, :balance)"
        );
        $stmt->execute([
            'user_id' => $source->user_id,
            'name'    => $source->name,
            'balance' => $source->balance,
        ]);

        return (int) $this->db->lastInsertId();
    }

    public function update(Source $source): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE sources SET user_id = :user_id, name = :name, balance = :balance WHERE id = :id"
        );

        return $stmt->execute([
            'user_id' => $source->user_id,
            'name'    => $source->name,
            'balance' => $source->balance,
            'id'      => $source->id,
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM sources WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
