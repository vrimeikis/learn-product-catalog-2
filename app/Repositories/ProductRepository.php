<?php

declare(strict_types = 1);

namespace App\Repositories;

use App\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

/**
 * Class ArticleRepository
 * @package App\Repositories
 */
class ProductRepository extends Repository
{

    /**
     * @return string
     */
    public function model(): string
    {
        return Product::class;
    }

    /**
     * Return first row from DB or null if not found
     *
     * @param string $slug
     * @return Builder|\Illuminate\Database\Eloquent\Model|null|object
     * @throws \Exception
     */
    public function getBySlug(string $slug)
    {
        return $this->getBySlugBuilder($slug)->first();
    }

    /**
     * @param string $slug
     * @param int $id
     * @return Builder|\Illuminate\Database\Eloquent\Model|null|object
     * @throws \Exception
     */
    public function getBySlugAndNotById(string $slug, int $id)
    {
        return $this->getBySlugBuilder($slug)
            ->where('id', '!=', $id)
            ->first();
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getFullData(): LengthAwarePaginator
    {
        $products = DB::table('products')->paginate();

        return $products;
    }

    /**
     * @param string $slug
     * @return Builder
     * @throws \Exception
     */
    private function getBySlugBuilder(string $slug): Builder
    {
        return $this->makeQuery()
            ->where('slug', $slug);
    }
}