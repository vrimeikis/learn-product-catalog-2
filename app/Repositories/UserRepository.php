<?php

declare (strict_types=1);

namespace App\Repositories;

use App\User;

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
}