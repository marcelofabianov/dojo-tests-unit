<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Model\Category;

interface CategoryServiceInterface
{
    public function create(string $name): Category;

    public function update(int $id, string $name): Category;

    public function delete(int $id): void;

    public function findAll(): array;

    public function find(int $id): Category;
}
