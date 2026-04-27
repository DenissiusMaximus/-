<?php

namespace Repositories;

use DataAccess\DbContext;
use Models\Aim;
use Repositories\Interfaces\IAimRepository;
use PDO;

class AimRepository implements IAimRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = DbContext::getConnection();
    }

    public function findAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM aims");
        $rows = $stmt->fetchAll();

        return array_map(fn($row) => new Aim(
            $row['user_id'],
            $row['name'],
            $row['target_amount'],
            $row['current_amount'],
            $row['id']
        ), $rows);
    }

    public function findById(int $id): ?Aim
    {
        $stmt = $this->db->prepare("SELECT * FROM aims WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        if (!$row) return null;

        return new Aim(
            $row['user_id'],
            $row['name'],
            $row['target_amount'],
            $row['current_amount'],
            $row['id']
        );
    }

    public function findByUserId(int $userId): array
    {
        $stmt = $this->db->prepare("SELECT * FROM aims WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        $rows = $stmt->fetchAll();

        return array_map(fn($row) => new Aim(
            $row['user_id'],
            $row['name'],
            $row['target_amount'],
            $row['current_amount'],
            $row['id']
        ), $rows);
    }

    public function create(Aim $aim): int
    {
        $stmt = $this->db->prepare(
            "INSERT INTO aims (user_id, name, target_amount, current_amount) VALUES (:user_id, :name, :target_amount, :current_amount)"
        );
        $stmt->execute([
            'user_id'        => $aim->user_id,
            'name'           => $aim->name,
            'target_amount'  => $aim->target_amount,
            'current_amount' => $aim->current_amount,
        ]);

        return (int) $this->db->lastInsertId();
    }

    public function update(Aim $aim): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE aims SET user_id = :user_id, name = :name, target_amount = :target_amount, current_amount = :current_amount WHERE id = :id"
        );

        return $stmt->execute([
            'user_id'        => $aim->user_id,
            'name'           => $aim->name,
            'target_amount'  => $aim->target_amount,
            'current_amount' => $aim->current_amount,
            'id'             => $aim->id,
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM aims WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
