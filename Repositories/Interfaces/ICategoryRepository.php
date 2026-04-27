<?php

namespace Repositories\Interfaces;

use Models\Category;

interface ICategoryRepository
{
    public function findAll(): array;
    public function findById(int $id): ?Category;
    public function create(Category $category): int;
    public function update(Category $category): bool;
    public function delete(int $id): bool;
}
