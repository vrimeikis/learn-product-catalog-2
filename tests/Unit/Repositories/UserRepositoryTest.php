<?php

declare (strict_types=1);

namespace Tests\Unit\Repositories;

use App\Repositories\UserRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
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
     * @test
     * @group user
     * @group user-repository
     */
    public function it_should_return_empty_collection_on_get_addresses(): void
    {
        $id = mt_rand(1, 10);

        $result = $this->getTestInstanceClass()->getAddresses($id);

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertEmpty($result);
    }

    /**
     * @test
     * @group user
     * @group user-repository
     */
    public function it_should_return_collection_on_get_addresses(): void
    {
        $id = mt_rand(1, 10);
        $address = str_random(20);

        DB::table('user_metas')
            ->insert([
                'user_id' => $id,
                'address' => $address,
            ]);

        $expectData = collect();
        $expectData->push((object)['address' => $address]);

        $result = $this->getTestInstanceClass()->getAddresses($id);

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertEquals($expectData->toArray(), $result->toArray());
    }

    /**
     * @test
     * @group user
     * @group user-repository
     */
    public function it_should_insert_address(): void
    {
        $result = $this->getTestInstanceClass()->addAddress([
            'user_id' => mt_rand(1, 10),
            'address' => str_random(20),
        ]);

        $this->assertTrue($result);
    }

    /**
     * @return UserRepository
     */
    private function getTestInstanceClass(): UserRepository
    {
        return $this->app->make(UserRepository::class);
    }
}
