<?php

declare (strict_types=1);

namespace App\Repositories;

use App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class UserRepository extends Repository
{

    /**
     * @return string
     */
    public function model(): string
    {
        return User::class;
    }

    /**
     * @param $userId
     * @return \Illuminate\Support\Collection
     */
    public function getAddresses(int $userId): Collection
    {
        return DB::table('user_metas')
            ->select(['address'])
            ->where('user_id', $userId)
            ->get();
    }

    /**
     * @param array $data
     * @return bool
     */
    public function addAddress(array $data): bool
    {
        return DB::table('user_metas')
            ->insert($data);
    }
}