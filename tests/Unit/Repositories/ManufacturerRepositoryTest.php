<?php

declare (strict_types=1);

namespace Tests\Unit\Repositories;

use App\Manufacturer;
use App\Repositories\ManufacturerRepository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\MemoryDatabaseMigrations;
use Tests\TestCase;

/**
 * Class ManufacturerRepositoryTest
 * @package Tests\Unit\Repositories
 */
class ManufacturerRepositoryTest extends TestCase
{
    use MemoryDatabaseMigrations;
    /**
     * @test
     * @group manufacturer
     * @group manufacturer-repository
     */
    public function it_should_create_singleton_instance(): void
    {
        $this->assertInstanceOf(ManufacturerRepository::class, $this->getTestClassInstance());
        $this->assertSame($this->getTestClassInstance(), $this->getTestClassInstance());
    }

    /**
     * @test
     * @group manufacturer
     * @group manufacturer-repository
     * @throws BindingResolutionException
     */
    public function it_should_return_null_on_get_by_slug_and_not_id(): void
    {
        factory(Manufacturer::class)->create();

        $manufacturer = factory(Manufacturer::class)->create();

        factory(Manufacturer::class)->create();

        $result = $this->getTestClassInstance()->getBySlugAndNotId($manufacturer->slug, $manufacturer->id);

        $this->assertInstanceOf(Manufacturer::class, $manufacturer);
        $this->assertNull($result);
    }

    /**
     * @test
     * @group manufacturer
     * @group manufacturer-repository
     * @throws BindingResolutionException
     */
    public function it_should_return_data_on_get_by_slug_and_not_id(): void
    {
        factory(Manufacturer::class)->create();

        $manufacturer = factory(Manufacturer::class)->create();

        factory(Manufacturer::class)->create();

        $result = $this->getTestClassInstance()->getBySlugAndNotId($manufacturer->slug, mt_rand(20, 30));

        $this->assertInstanceOf(Manufacturer::class, $manufacturer);
        $this->assertEquals($manufacturer->toArray(), $result->toArray());
    }

    /**
     * @return ManufacturerRepository
     */
    private function getTestClassInstance(): ManufacturerRepository
    {
        return $this->app->make(ManufacturerRepository::class);
    }
}
