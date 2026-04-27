<?php

namespace Services\Interfaces;

use Models\Aim;

interface IAimService
{
    public function getAll(): array;
    public function getById(int $id): ?Aim;
    public function getByUserId(int $userId): array;
    public function create(Aim $aim): int;
    public function update(Aim $aim): bool;
    public function delete(int $id): bool;
}
