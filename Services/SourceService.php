<?php

namespace Services;

use Models\Source;
use Repositories\Interfaces\ISourceRepository;
use Services\Interfaces\ISourceService;

class SourceService implements ISourceService
{
    public function __construct(
        private ISourceRepository $sourceRepository
    ) {}

    public function getAll(): array
    {
        return $this->sourceRepository->findAll();
    }

    public function getById(int $id): ?Source
    {
        return $this->sourceRepository->findById($id);
    }

    public function getByUserId(int $userId): array
    {
        return $this->sourceRepository->findByUserId($userId);
    }

    public function create(Source $source): int
    {
        return $this->sourceRepository->create($source);
    }

    public function update(Source $source): bool
    {
        return $this->sourceRepository->update($source);
    }

    public function delete(int $id): bool
    {
        return $this->sourceRepository->delete($id);
    }
}
