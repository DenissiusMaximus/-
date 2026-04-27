<?php

namespace Services\Interfaces;

use Models\Category;

interface ICategoryService
{
    public function getAll(): array;
    public function getById(int $id): ?Category;
    public function create(Category $category): int;
    public function update(Category $category): bool;
    public function delete(int $id): bool;
}
