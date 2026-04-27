<?php

namespace Repositories\Interfaces;

use Models\Aim;

interface IAimRepository
{
    public function findAll(): array;
    public function findById(int $id): ?Aim;
    public function findByUserId(int $userId): array;
    public function create(Aim $aim): int;
    public function update(Aim $aim): bool;
    public function delete(int $id): bool;
}
