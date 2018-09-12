<?php

declare (strict_types=1);

namespace App\Repositories;

use App\Manufacturer;

/**
 * Class ManufacturerRepository
 * @package App\Repositories
 */
class ManufacturerRepository extends Repository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Manufacturer::class;
    }
}