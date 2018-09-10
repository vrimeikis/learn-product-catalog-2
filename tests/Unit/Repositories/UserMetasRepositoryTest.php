<?php

declare (strict_types=1);

namespace Tests\Unit\Repositories;

use App\Repositories\UserMetasRepository;
use Tests\TestCase;

/**
 * Class UserMetasRepositoryTest
 * @package Tests\Unit\Repositories
 */
class UserMetasRepositoryTest extends TestCase
{
    /**
     * @test
     * @group user
     * @group user-metas
     * @group user-metas-repository
     */
    public function it_should_create_singleton_instance(): void
    {
        $this->assertInstanceOf(UserMetasRepository::class, $this->getTestClassInstance());
        $this->assertSame($this->getTestClassInstance(), $this->getTestClassInstance());
    }

    /**
     * @return UserMetasRepository
     */
    private function getTestClassInstance(): UserMetasRepository
    {
        return $this->app->make(UserMetasRepository::class);
    }
}
