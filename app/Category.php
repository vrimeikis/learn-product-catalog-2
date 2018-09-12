<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @package App
 */
class Category extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'active',
        'cover',
    ];
}
