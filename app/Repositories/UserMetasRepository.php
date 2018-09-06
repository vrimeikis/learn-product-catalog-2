<?php

declare (strict_types=1);

namespace App\Repositories;

use App\UserMetas;

/**
 * Class UserMetasRepository
 * @package App\Repositories
 */
class UserMetasRepository extends Repository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return UserMetas::class;
    }
}