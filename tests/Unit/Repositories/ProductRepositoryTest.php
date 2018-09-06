<?php

namespace Tests\Unit\Repositories;

use App\Http\Requests\ProductStoreRequest;
use App\Repositories\ProductRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductRepositoryTest extends TestCase
{

    /**
     * @test
     * @group article
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
