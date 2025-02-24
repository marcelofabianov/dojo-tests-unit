<?php

declare(strict_types=1);

namespace App\Repository;

use App\Interfaces\CategoryRepositoryInterface;
use App\Model\Category;

class CategoryRepositoryInMemory implements CategoryRepositoryInterface
{
    /** @var Category[] */
    private array $categories = [];

    public function create(Category $category): Category
    {
        $this->categories[$category->getId()] = $category;

        return $category;
    }

    public function exists(string $name): bool
    {
        foreach ($this->categories as $category) {
            if ($category->getName() === $name) {
                return true;
            }
        }

        return false;
    }

    public function update(Category $category): void
    {
        $this->categories[$category->getId()] = $category;
    }

    public function delete(Category $category): void
    {
        unset($this->categories[$category->getId()]);
    }

    public function find(int $id): ?Category
    {
        return $this->categories[$id] ?? null;
    }

    /** @return Category[] */
    public function findAll(): array
    {
        return array_values($this->categories);
    }
}
