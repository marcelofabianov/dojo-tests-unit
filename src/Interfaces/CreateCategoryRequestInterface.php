<?php

declare(strict_types=1);

namespace App\Interfaces;

interface CreateCategoryRequestInterface
{
    public function getErrors(): array;

    public function validate(string|null $name): bool;
}
