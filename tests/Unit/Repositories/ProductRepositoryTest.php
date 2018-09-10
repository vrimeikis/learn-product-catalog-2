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
    public function it_should_return_data_by_slug_and_not_id(): void
    {
        /** @var Product $product1 */
        $product1 = factory(Product::class)->create();

        /** @var Product $product2 */
        $product2 = factory(Product::class)->create();

        $result = $this->getTestClassInstance()->getBySlugAndNotById($product1->slug, $product2->id);

        $this->assertInstanceOf(Product::class, $result);
        $this->assertEquals($product1->toArray(), $result->toArray());
    }

    /**
     * @test
     * @group article
     * @group article-repository
     */
    public function it_should_return_empty_paginator(): void
    {
        $result = $this->getTestClassInstance()->getFullData();

        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
        $this->assertTrue($result->isEmpty());
    }


    /**
     * @test
     * @group article
     * @throws \Exception
     */
    public function it_should_return_null_by_slug_and_not_id_empty_db(): void
    {
        $slug = str_random(10);
        $id = mt_rand(1, 10);

        $this->assertNull($this->getTestClassInstance()->getBySlugAndNotById($slug, $id));
    }


    /**
     * @test
     * @group article
     * @throws \Exception
     */
    public function it_should_return_null_by_slug_and_not_id(): void
    {
        /** @var Product $product */
        $product = factory(Product::class)->create();

        $this->assertNull($this->getTestClassInstance()->getBySlugAndNotById($product->slug, $product->id));
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
     * @test
     * @group product
     * @group product-repository
     * @throws \Exception
     */
    public function it_should_expect_model_not_found_on_by_id(): void
    {
        $id = mt_rand(1, 100);

        $this->expectException(ModelNotFoundException::class);

        $this->getTestClassInstance()->getFullDataById($id);
    }


    /**
     * @return ProductRepository
     */
    private function getTestClassInstance(): ProductRepository
    {
        return $this->app->make(ProductRepository::class);
    }
}
