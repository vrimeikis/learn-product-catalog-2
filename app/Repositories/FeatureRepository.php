<?php

declare(strict_types = 1);

namespace App\Repositories;


use App\Feature;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FeatureRepository
 * @package App\Repositories
 */
class FeatureRepository extends Repository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Feature::class;
    }

    /**
     * @param string $slug
     * @return Feature|Model|null
     * @throws BindingResolutionException
     */
    public function getBySlug(string $slug): ? Feature
    {
        return $this->getBySlugBuilder($slug)
            ->first();
    }

    /**
     * @param string $slug
     * @param int $id
     * @return Feature|Model|null
     * @throws BindingResolutionException
     */
    public function getBySlugAndNotId(string $slug, int $id): ? Feature
    {
        return $this->getBySlugBuilder($slug)
            ->where('id', '!=', $id)
            ->first();
    }

    /**
     * @param string $slug
     * @return Builder
     * @throws BindingResolutionException
     */
    private function getBySlugBuilder(string $slug): Builder
    {
        return $this->makeQuery()
            ->where('slug', $slug);
    }
}