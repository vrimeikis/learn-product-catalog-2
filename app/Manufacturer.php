<?php

declare (strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Manufacturer
 * @package App
 */
class Manufacturer extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'address',
        'email',
        'phone',
        'logo',
        'active',
    ];
}
