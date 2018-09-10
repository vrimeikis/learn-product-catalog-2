<?php

declare(strict_types = 1);

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App
 */
class Product extends Model
{

    /**
     * @var $array
     */
    protected $fillable = [

        'title',
        'price',
        'context',
        'cover',
        'slug',
        'active',

    ];
}
