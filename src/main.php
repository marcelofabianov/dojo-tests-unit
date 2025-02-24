<?php

declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use App\Controller\CategoryController;
use App\Repository\CategoryRepositoryInMemory;
use App\Request\CreateCreateCategoryRequest;
use App\Service\CategoryService;

function main(): void {
    // POST REQUEST FAKE
    $name = 'Marcelo';

    $controller = new CategoryController(
        new CreateCreateCategoryRequest(),
        new CategoryService(
            new CategoryRepositoryInMemory(),
        )
    );

    $response = $controller->create($name);

    echo $response.PHP_EOL;
    echo 'StatusCode: '.$response->getStatus().PHP_EOL;

    echo PHP_EOL;
}
