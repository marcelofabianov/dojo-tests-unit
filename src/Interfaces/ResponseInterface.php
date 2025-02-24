<?php

declare(strict_types=1);

namespace App\Interfaces;

interface ResponseInterface
{
    public function __construct(array $data, int $status = 200);

    public function __toString(): string;

    public function getStatus(): int;
}
