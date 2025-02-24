<?php

declare(strict_types=1);

namespace App\Controller;

use App\Exceptions\CategoryAlreadyExistsException;
use App\Interfaces\CategoryServiceInterface;
use App\Interfaces\CreateCategoryRequestInterface;
use App\Interfaces\ResponseInterface;
use App\Response\JsonResponse;
use Exception;

readonly class CategoryController
{
    public function __construct(
        private CreateCategoryRequestInterface $request,
        private CategoryServiceInterface $service
    ){}

    public function create(string $name): ResponseInterface
    {
        if ($this->request->validate($name) === false) {
            return new JsonResponse(['errors' => $this->request->getErrors()], 400);
        }

        try {
            $category = $this->service->create($name);
        } catch (CategoryAlreadyExistsException $e) {
            return new JsonResponse(['error' => $e->getMessage()], 400);
        } catch (Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }

        return new JsonResponse(['data' => $category->toArray()], 201);
    }
}
