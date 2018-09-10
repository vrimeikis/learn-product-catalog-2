<?php

declare (strict_types=1);

namespace Tests\Unit\Repositories;

use App\Repositories\UserRepository;
use Tests\MemoryDatabaseMigrations;
use Tests\TestCase;

/**
 * Class UserRepositoryTest
 * @package Tests\Unit\Repositories
 */
class UserRepositoryTest extends TestCase
{
    use MemoryDatabaseMigrations;
    /**
     * @test
     * @group user
     * @group user-repository
     */
    public function it_should_make_singleton_instance(): void
    {
        $this->assertInstanceOf(UserRepository::class, $this->getTestInstanceClass());
        $this->assertSame($this->getTestInstanceClass(), $this->getTestInstanceClass());
    }

    /**
     * @return UserRepository
     */
    private function getTestInstanceClass(): UserRepository
    {
        return $this->app->make(UserRepository::class);
    }
}
