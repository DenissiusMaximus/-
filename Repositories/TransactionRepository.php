<?php

namespace Repositories;

use DataAccess\DbContext;
use Models\Transaction;
use Repositories\Interfaces\ITransactionRepository;
use PDO;

class TransactionRepository implements ITransactionRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = DbContext::getConnection();
    }

    public function findAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM transactions");
        $rows = $stmt->fetchAll();

        return array_map(fn($row) => new Transaction(
            $row['user_id'],
            $row['source_id'],
            $row['category_id'],
            $row['amount'],
            $row['comment'],
            $row['date'],
            $row['id']
        ), $rows);
    }

    public function findById(int $id): ?Transaction
    {
        $stmt = $this->db->prepare("SELECT * FROM transactions WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        if (!$row) return null;

        return new Transaction(
            $row['user_id'],
            $row['source_id'],
            $row['category_id'],
            $row['amount'],
            $row['comment'],
            $row['date'],
            $row['id']
        );
    }

    public function findByUserId(int $userId): array
    {
        $stmt = $this->db->prepare("SELECT * FROM transactions WHERE user_id = :user_id ORDER BY date DESC");
        $stmt->execute(['user_id' => $userId]);
        $rows = $stmt->fetchAll();

        return array_map(fn($row) => new Transaction(
            $row['user_id'],
            $row['source_id'],
            $row['category_id'],
            $row['amount'],
            $row['comment'],
            $row['date'],
            $row['id']
        ), $rows);
    }

    public function create(Transaction $transaction): int
    {
        $stmt = $this->db->prepare(
            "INSERT INTO transactions (user_id, source_id, category_id, amount, comment, date)
             VALUES (:user_id, :source_id, :category_id, :amount, :comment, :date)"
        );
        $stmt->execute([
            'user_id'     => $transaction->user_id,
            'source_id'   => $transaction->source_id,
            'category_id' => $transaction->category_id,
            'amount'      => $transaction->amount,
            'comment'     => $transaction->comment,
            'date'        => $transaction->date,
        ]);

        return (int) $this->db->lastInsertId();
    }

    public function update(Transaction $transaction): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE transactions
             SET user_id = :user_id, source_id = :source_id, category_id = :category_id,
                 amount = :amount, comment = :comment, date = :date
             WHERE id = :id"
        );

        return $stmt->execute([
            'user_id'     => $transaction->user_id,
            'source_id'   => $transaction->source_id,
            'category_id' => $transaction->category_id,
            'amount'      => $transaction->amount,
            'comment'     => $transaction->comment,
            'date'        => $transaction->date,
            'id'          => $transaction->id,
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM transactions WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function getPaginatedByUserId(int $userId, int $limit, int $offset): array
    {
        $stmt = $this->db->prepare("SELECT * FROM transactions WHERE user_id = :user_id ORDER BY date DESC LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll();

        return array_map(fn($row) => new Transaction(
            $row['user_id'],
            $row['source_id'],
            $row['category_id'],
            $row['amount'],
            $row['comment'],
            $row['date'],
            $row['id']
        ), $rows);
    }

    public function getPaginatedAll(int $limit, int $offset): array
    {
        $stmt = $this->db->prepare("SELECT * FROM transactions ORDER BY date DESC LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll();

        return array_map(fn($row) => new Transaction(
            $row['user_id'],
            $row['source_id'],
            $row['category_id'],
            $row['amount'],
            $row['comment'],
            $row['date'],
            $row['id']
        ), $rows);
    }
}
