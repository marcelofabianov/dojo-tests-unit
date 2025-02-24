<?php

declare(strict_types=1);

namespace App\Response;

use App\Interfaces\ResponseInterface;

readonly class JsonResponse implements ResponseInterface
{
    public function __construct(
        private array $data,
        private int $status = 200
    ){}

    /**
     * @throws \JsonException
     */
    public function __toString(): string
    {
        return json_encode($this->data, JSON_THROW_ON_ERROR | $this->status);
    }

    public function getStatus(): int
    {
        return $this->status;
    }
}
