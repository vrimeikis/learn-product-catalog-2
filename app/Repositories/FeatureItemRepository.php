<?php

declare(strict_types = 1);

namespace App\Repositories;

use App\FeatureItem;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FeatureItemRepository
 * @package App\Repositories
 */
class FeatureItemRepository extends Repository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return FeatureItem::class;
    }

    /**
     * @param string $slug
     * @return FeatureItem|Model|null
     * @throws BindingResolutionException
     */
    public function getBySlug(string $slug): ? FeatureItem
    {
        return $this->getBySlugBuilder($slug)
            ->first();
    }

    /**
     * @param string $slug
     * @param int $id
     * @return FeatureItem|Model|null
     * @throws BindingResolutionException
     */
    public function getBySlugAndNotId(string $slug, int $id): ? FeatureItem
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