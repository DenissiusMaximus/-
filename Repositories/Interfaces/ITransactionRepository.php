<?php

namespace Repositories\Interfaces;

use Models\Transaction;

interface ITransactionRepository
{
    public function findAll(): array;
    public function findById(int $id): ?Transaction;
    public function findByUserId(int $userId): array;
    public function create(Transaction $transaction): int;
    public function update(Transaction $transaction): bool;
    public function delete(int $id): bool;
}
