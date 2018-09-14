<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Feature
 * @package App
 */
class FeatureItem extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'active',
    ];
}
