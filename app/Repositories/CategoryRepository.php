<?php

declare(strict_types = 1);

namespace App\Repositories;

use App\Category;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CategoryRepository
 * @package App\Repositories
 */
class CategoryRepository extends Repository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Category::class;
    }

    /**
     * @param string $slug
     * @return Category|Model|null
     * @throws BindingResolutionException
     */
    public function getBySlug(string $slug): ? Category
    {
        return $this->getBySlugBuilder($slug)
            ->first();
    }

    /**
     * @param string $slug
     * @param int $id
     * @return Category|Model|null
     * @throws BindingResolutionException
     */
    public function getBySlugAndNotId(string $slug, int $id): ? Category
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