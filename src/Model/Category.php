<?php

declare(strict_types=1);

namespace App\Model;

use App\Interfaces\ModelInterface;

class Category implements ModelInterface
{
    private int $id;
    private string $name;

    public function __construct(string $name)
    {
        $this->id = 1;
        $this->name = $name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }
}
