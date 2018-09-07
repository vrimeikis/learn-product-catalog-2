<?php
/**
 * Created by PhpStorm.
 * User: evis
 * Date: 18.9.6
 * Time: 18.22
 */

namespace App\Repositories\Admin;


use App\Category;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Builder;

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
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getBySlug(string $slug)
    {
        return $this->getBySlugBuilder($slug)
            ->first();
    }

    /**
     * @param string $slug
     * @param int $id
     * @return Builder|\Illuminate\Database\Eloquent\Model|null|object
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getBySlugAndNotId(string $slug, int $id)
    {
        return $this->getBySlugBuilder($slug)
            ->where('id', '!=', $id)
            ->first();
    }

    /**
     * @param string $slug
     * @return Builder
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function getBySlugBuilder(string $slug): Builder
    {
        return $this->makeQuery()
            ->where('slug', $slug);
    }
}