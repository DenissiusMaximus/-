<?php

namespace Services;

use Models\Category;
use Repositories\Interfaces\ICategoryRepository;
use Services\Interfaces\ICategoryService;

class CategoryService implements ICategoryService
{
    public function __construct(
        private ICategoryRepository $categoryRepository
    ) {}

    public function getAll(): array
    {
        return $this->categoryRepository->findAll();
    }

    public function getById(int $id): ?Category
    {
        return $this->categoryRepository->findById($id);
    }

    public function create(Category $category): int
    {
        return $this->categoryRepository->create($category);
    }

    public function update(Category $category): bool
    {
        return $this->categoryRepository->update($category);
    }

    public function delete(int $id): bool
    {
        return $this->categoryRepository->delete($id);
    }
}
