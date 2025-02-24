<?php

declare(strict_types=1);

namespace App\Request;

use App\Interfaces\CreateCategoryRequestInterface;

class CreateCreateCategoryRequest implements CreateCategoryRequestInterface
{
    private array $errors;

    public function __construct(){
        $this->errors = [];
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function validate(string|null $name): bool
    {
        if (empty($name)) {
            $this->errors['name'] = 'Name is required';
        }

        if (strlen($name) < 3) {
            $this->errors['name'] = 'Name must be at least 3 characters';
        }

        return empty($this->errors);
    }
}
