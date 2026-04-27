<?php

namespace Repositories\Interfaces;

use Models\Source;

interface ISourceRepository
{
    public function findAll(): array;
    public function findById(int $id): ?Source;
    public function findByUserId(int $userId): array;
    public function create(Source $source): int;
    public function update(Source $source): bool;
    public function delete(int $id): bool;
}
