<?php

namespace Services;

use Models\Aim;
use Repositories\Interfaces\IAimRepository;
use Services\Interfaces\IAimService;

class AimService implements IAimService
{
    public function __construct(
        private IAimRepository $aimRepository
    ) {}

    public function getAll(): array
    {
        return $this->aimRepository->findAll();
    }

    public function getById(int $id): ?Aim
    {
        return $this->aimRepository->findById($id);
    }

    public function getByUserId(int $userId): array
    {
        return $this->aimRepository->findByUserId($userId);
    }

    public function create(Aim $aim): int
    {
        return $this->aimRepository->create($aim);
    }

    public function update(Aim $aim): bool
    {
        return $this->aimRepository->update($aim);
    }

    public function delete(int $id): bool
    {
        return $this->aimRepository->delete($id);
    }
}
