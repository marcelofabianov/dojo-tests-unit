<?php

declare(strict_types=1);

namespace App\Service;

use App\Exceptions\CategoryAlreadyExistsException;
use App\Exceptions\CategoryNotFoundException;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\CategoryServiceInterface;
use App\Model\Category;

readonly class CategoryService implements CategoryServiceInterface
{
    public function __construct(
        private CategoryRepositoryInterface $repository
    ){}

    public function create(string $name): Category
    {
        $category = new Category($name);

        if ($this->repository->exists($name)) {
            throw new CategoryAlreadyExistsException($name);
        }

        return $this->repository->create($category);
    }

    /**
     * @throws \App\Exceptions\CategoryNotFoundException
     */
    public function update(int $id, string $name): Category
    {
        $category = $this->repository->find($id);

        if ($category === null) {
            throw new CategoryNotFoundException($id);
        }

        $category->setName($name);

        $this->repository->update($category);

        return $category;
    }

    /**
     * @throws \App\Exceptions\CategoryNotFoundException
     */
    public function delete(int $id): void
    {
        $category = $this->repository->find($id);

        if ($category === null) {
            throw new CategoryNotFoundException($id);
        }

        $this->repository->delete($category);
    }

    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    /**
     * @throws \App\Exceptions\CategoryNotFoundException
     */
    public function find(int $id): Category
    {
        $category = $this->repository->find($id);

        if ($category === null) {
            throw new CategoryNotFoundException($id);
        }

        return $category;
    }
}
