<?php

namespace Repositories;

use DataAccess\DbContext;
use Models\User;
use Repositories\Interfaces\IUserRepository;
use PDO;

class UserRepository implements IUserRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = DbContext::getConnection();
    }

    public function findAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM users");
        $rows = $stmt->fetchAll();

        return array_map(fn($row) => new User(
            $row['name'],
            $row['email'],
            $row['password_hash'],
            $row['role'],
            $row['id']
        ), $rows);
    }

    public function findById(int $id): ?User
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        if (!$row) return null;

        return new User(
            $row['name'],
            $row['email'],
            $row['password_hash'],
            $row['role'],
            $row['id']
        );
    }

    public function findByEmail(string $email): ?User
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch();

        if (!$row) return null;

        return new User(
            $row['name'],
            $row['email'],
            $row['password_hash'],
            $row['role'],
            $row['id']
        );
    }

    public function create(User $user): int
    {
        $stmt = $this->db->prepare(
            "INSERT INTO users (name, email, password_hash, role) VALUES (:name, :email, :password_hash, :role)"
        );
        $stmt->execute([
            'name'          => $user->name,
            'email'         => $user->email,
            'password_hash' => $user->password_hash,
            'role'          => $user->role,
        ]);

        return (int) $this->db->lastInsertId();
    }

    public function update(User $user): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE users SET name = :name, email = :email, password_hash = :password_hash, role = :role WHERE id = :id"
        );

        return $stmt->execute([
            'name'          => $user->name,
            'email'         => $user->email,
            'password_hash' => $user->password_hash,
            'role'          => $user->role,
            'id'            => $user->id,
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
