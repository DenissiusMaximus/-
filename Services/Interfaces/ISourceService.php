<?php

namespace Services\Interfaces;

use Models\Source;

interface ISourceService
{
    public function getAll(): array;
    public function getById(int $id): ?Source;
    public function getByUserId(int $userId): array;
    public function create(Source $source): int;
    public function update(Source $source): bool;
    public function delete(int $id): bool;
}
