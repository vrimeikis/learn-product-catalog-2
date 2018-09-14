<?php

declare(strict_types = 1);

namespace App\Repositories;

use App\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
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
}