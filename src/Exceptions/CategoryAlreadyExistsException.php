<?php

declare(strict_types=1);

namespace App\Exceptions;

use RuntimeException;

class CategoryAlreadyExistsException extends RuntimeException
{
    public function __construct(string $name)
    {
        $message = "Category with name {$name} already exists.";
        parent::__construct($message);
    }
}
