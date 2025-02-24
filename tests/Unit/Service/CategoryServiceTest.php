<?php

declare(strict_types=1);

namespace Tests\Unit\Service;

use App\Exceptions\CategoryAlreadyExistsException;
use App\Exceptions\CategoryNotFoundException;
use App\Interfaces\CategoryRepositoryInterface;
use App\Model\Category;
use App\Service\CategoryService;
use PHPUnit\Framework\TestCase;

class CategoryServiceTest extends TestCase
{
    private CategoryRepositoryInterface $repository;
    private CategoryService $service;

    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    protected function setUp(): void
    {
        $this->repository = $this->createMock(CategoryRepositoryInterface::class);
        $this->service = new CategoryService($this->repository);
    }

    // testCriar_QuandoCategoriaNaoExiste_DeveCriarCategoria
    public function testCreate_WhenCategoryDoesNotExist_ShouldCreateCategory(): void
    {
        $name = "Eletrônicos";
        $category = new Category($name);

        $this->repository->expects($this->once())
            ->method('exists')
            ->with($name)
            ->willReturn(false);

        $this->repository->expects($this->once())
            ->method('create')
            ->with($this->callback(fn (Category $c) => $c->getName() === $name))
            ->willReturn($category);

        $result = $this->service->create($name);

        $this->assertSame($category, $result);
    }

    // testCriar_QuandoCategoriaJaExiste_DeveLancarExcecao
    public function testCreate_WhenCategoryAlreadyExists_ShouldThrowException(): void
    {
        $name = "Eletrônicos";

        $this->repository->expects($this->once())
            ->method('exists')
            ->with($name)
            ->willReturn(true);

        $this->expectException(CategoryAlreadyExistsException::class);

        $this->service->create($name);
    }

    // testAtualizar_QuandoCategoriaExiste_DeveAtualizarCategoria
    public function testUpdate_WhenCategoryExists_ShouldUpdateCategory(): void
    {
        $id = 1;
        $newName = "Eletrodomésticos";
        $category = new Category("Eletrônicos");

        $this->repository->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn($category);

        $this->repository->expects($this->once())
            ->method('update')
            ->with($this->callback(fn (Category $c) => $c->getName() === $newName));

        $result = $this->service->update($id, $newName);

        $this->assertSame($newName, $result->getName());
    }

    // testAtualizar_QuandoCategoriaNaoExiste_DeveLancarExcecao
    public function testUpdate_WhenCategoryDoesNotExist_ShouldThrowException(): void
    {
        $id = 1;
        $newName = "Eletrodomésticos";

        $this->repository->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn(null);

        $this->expectException(CategoryNotFoundException::class);

        $this->service->update($id, $newName);
    }

    // testDeletar_QuandoCategoriaExiste_DeveDeletarCategoria
    public function testDelete_WhenCategoryExists_ShouldDeleteCategory(): void
    {
        $id = 1;
        $category = new Category("Eletrônicos");

        $this->repository->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn($category);

        $this->repository->expects($this->once())
            ->method('delete')
            ->with($category);

        $this->service->delete($id);
    }

    // testDeletar_QuandoCategoriaNaoExiste_DeveLancarExcecao
    public function testDelete_WhenCategoryDoesNotExist_ShouldThrowException(): void
    {
        $id = 1;

        $this->repository->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn(null);

        $this->expectException(CategoryNotFoundException::class);

        $this->service->delete($id);
    }

    // testBuscar_QuandoCategoriaExiste_DeveRetornarCategoria
    public function testFind_WhenCategoryExists_ShouldReturnCategory(): void
    {
        $id = 1;
        $category = new Category("Eletrônicos");

        $this->repository->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn($category);

        $result = $this->service->find($id);

        $this->assertSame($category, $result);
    }

    // testBuscar_QuandoCategoriaNaoExiste_DeveLancarExcecao
    public function testFind_WhenCategoryDoesNotExist_ShouldThrowException(): void
    {
        $id = 1;

        $this->repository->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn(null);

        $this->expectException(CategoryNotFoundException::class);

        $this->service->find($id);
    }

    // testBuscarTodas_DeveRetornarTodasCategorias
    public function testFindAll_ShouldReturnAllCategories(): void
    {
        $categories = [
            new Category("Eletrônicos"),
            new Category("Roupas"),
        ];

        $this->repository->expects($this->once())
            ->method('findAll')
            ->willReturn($categories);

        $result = $this->service->findAll();

        $this->assertSame($categories, $result);
    }
}
