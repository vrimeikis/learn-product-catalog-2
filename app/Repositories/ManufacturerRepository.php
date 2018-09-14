<?php

declare (strict_types=1);

namespace App\Repositories;

use App\Manufacturer;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

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

    /**
     * @param string $slug
     * @param int $id
     * @return Builder|Model|null|object
     * @throws BindingResolutionException
     */
    public function getBySlugAndNotId(string $slug, int $id)
    {
        return $this->makeQuery()
            ->where('slug', '=', $slug)
            ->where('id', '!=', $id)
            ->first();
    }
}