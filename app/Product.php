<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
