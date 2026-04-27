<?php

namespace Services;

use Models\Transaction;
use Repositories\Interfaces\ITransactionRepository;
use Services\Interfaces\ITransactionService;

class TransactionService implements ITransactionService
{
    public function __construct(
        private ITransactionRepository $transactionRepository
    ) {}

    public function getAll(): array
    {
        return $this->transactionRepository->findAll();
    }

    public function getById(int $id): ?Transaction
    {
        return $this->transactionRepository->findById($id);
    }

    public function getByUserId(int $userId): array
    {
        return $this->transactionRepository->findByUserId($userId);
    }

    public function create(Transaction $transaction): int
    {
        return $this->transactionRepository->create($transaction);
    }

    public function update(Transaction $transaction): bool
    {
        return $this->transactionRepository->update($transaction);
    }

    public function delete(int $id): bool
    {
        return $this->transactionRepository->delete($id);
    }
}
