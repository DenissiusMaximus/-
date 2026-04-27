<?php

namespace Services;

use Models\User;
use Repositories\Interfaces\IUserRepository;
use Services\Interfaces\IUserService;

class UserService implements IUserService
{
    public function __construct(
        private IUserRepository $userRepository
    ) {}

    public function getAll(): array
    {
        return $this->userRepository->findAll();
    }

    public function getById(int $id): ?User
    {
        return $this->userRepository->findById($id);
    }

    public function create(User $user): int
    {
        return $this->userRepository->create($user);
    }

    public function update(User $user): bool
    {
        return $this->userRepository->update($user);
    }

    public function delete(int $id): bool
    {
        return $this->userRepository->delete($id);
    }
}
