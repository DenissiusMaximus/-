<?php

namespace Services\Interfaces;

use Models\Transaction;

interface ITransactionService
{
    public function getAll(): array;
    public function getById(int $id): ?Transaction;
    public function getByUserId(int $userId): array;
    public function create(Transaction $transaction): int;
    public function update(Transaction $transaction): bool;
    public function delete(int $id): bool;
}
