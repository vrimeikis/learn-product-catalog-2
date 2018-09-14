<?php

declare(strict_types =1);

namespace Tests\Unit\Repositories;

use App\Product;
use App\Repositories\ProductRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tests\MemoryDatabaseMigrations;
use Tests\TestCase;


/**
 * Class ProductRepositoryTest
 * @package Tests\Unit\Repositories
 */
class ProductRepositoryTest extends TestCase
{
    use MemoryDatabaseMigrations;
    /**
     * @test
     * @group product
     *
     */
    public function it_should_create_singleton_instance(): void
    {
        $this->assertInstanceOf(ProductRepository::class, $this->getTestClassInstance());
        $this->assertSame($this->getTestClassInstance(), $this->getTestClassInstance());
    }

    /**
     * @return ProductRepository
     */
    private function getTestClassInstance(): ProductRepository
    {
        return $this->app->make(ProductRepository::class);
    }
}
