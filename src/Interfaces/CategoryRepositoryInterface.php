<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Model\Category;

interface CategoryRepositoryInterface
{
    public function create(Category $category): Category;

    public function exists(string $name): bool;

    public function update(Category $category): void;

    public function delete(Category $category): void;

    public function find(int $id): ?Category;

    public function findAll(): array;
}
