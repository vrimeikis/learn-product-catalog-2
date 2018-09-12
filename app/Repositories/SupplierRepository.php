<?php
/**
 * Created by PhpStorm.
 * User: mind
 * Date: 18.9.12
 * Time: 19.09
 */
declare(strict_types=1);

namespace App\Repositories;



use App\Supplier;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;



class SupplierRepository extends Repository
{

    /**
     * @return string
     */
    public function model(): string
    {
        return Supplier::class;
    }

    /**
     * @param string $slug
     * @return Supplier|Model|null
     * @throws BindingResolutionException
     */
    public function getBySlug(string $slug): ? Supplier
    {
        return $this->getBySlugBuilder($slug)
            ->first();
    }

    /**
     * @param string $slug
     * @param int $id
     * @return Supplier|Model|null
     * @throws BindingResolutionException
     */
    public function getBySlugAndNotId(string $slug, int $id): ? Supplier
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
