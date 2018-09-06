<?php

namespace Tests\Unit\Repositories;

use App\Product;
use App\Repositories\ProductRepository;
use Tests\MemoryDatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
     * @test
     * @group product
     * @throws \Exception
     */
    public function it_should_return_data_by_slug(): void
    {
        /* @var Product $product */
        $product = factory(Product::class)->create();

        factory(Product::class)->create();


        $result = $this->getTestClassInstance()->getBySlug($product->slug);

        $this->assertInstanceOf(Product::class, $result);
        $this->assertEquals($product->toArray(), $result->toArray());
    }

    /**
     * @test
     * @group product
     * @throws \Exception
     */
    public function it_should_return_null_on_get_by_slug(): void
    {
        $slug = str_random(10);

        $this->assertNull($this->getTestClassInstance()->getBySlug($slug));
    }

    /**
     * @return ProductRepository
     */
    private function getTestClassInstance(): ProductRepository
    {
        return $this->app->make(ProductRepository::class);
    }
}
