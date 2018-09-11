<?php
/**
 * Created by PhpStorm.
 * User: evis
 * Date: 18.9.6
 * Time: 19.08
 */

declare(strict_types = 1);

namespace Tests\Unit\Repositories;


use App\Category;
use App\Repositories\CategoryRepository;
use Tests\MemoryDatabaseMigrations;
use Tests\TestCase;

/**
 * Class CategoryRepositoryTest
 * @package Tests\Unit\Repositories
 */
class CategoryRepositoryTest extends TestCase
{

    use MemoryDatabaseMigrations;
    /**
     * @group category-repository
     * @test
     */
    public function it_should_create_singleton_instance(): void
    {
        $this->assertInstanceOf(CategoryRepository::class, $this->getTestClassInstance());
        $this->assertSame($this->getTestClassInstance(), $this->getTestClassInstance());
    }

    /**
     * @group category-repository
     * @test
     * @throws \Exception
     */
    public function it_should_return_null_on_get_by_slug(): void
    {
        $slug = str_random(10);

        $result = $this->getTestClassInstance()->getBySlug($slug);

        $this->assertNull($result);
    }

    /**
     * @test
     * @throws \Exception
     */
    public function it_should_return_category_by_slug(): void
    {
        factory(Category::class)->create();

        /** @var Category $category */
        $category = factory(Category::class)->create();

        factory(Category::class)->create();

        $result = $this->getTestClassInstance()->getBySlug($category->slug);

        $this->assertInstanceOf(Category::class, $result);
        $this->assertEquals($category->toArray(), $result->toArray());
    }

    /**
     * @return CategoryRepository
     */
    private function getTestClassInstance(): CategoryRepository
    {
        return $this->app->make(CategoryRepository::class);
    }
}