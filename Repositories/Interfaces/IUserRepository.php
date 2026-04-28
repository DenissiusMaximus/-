<?php

namespace Repositories\Interfaces;

use Models\User;

interface IUserRepository
{
    public function findAll(): array;
    public function findById(int $id): ?User;
    public function findByEmail(string $email): ?User;
    public function create(User $user): int;
    public function update(User $user): bool;
    public function delete(int $id): bool;
}
