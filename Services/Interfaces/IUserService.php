<?php

namespace Services\Interfaces;

use Models\User;

interface IUserService
{
    public function getAll(): array;
    public function getById(int $id): ?User;
    public function create(User $user): int;
    public function update(User $user): bool;
    public function delete(int $id): bool;
}
