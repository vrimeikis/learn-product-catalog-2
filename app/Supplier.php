<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Supplier
 * @package App
 */
class Supplier extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'address',
        'phone',
        'email',
        'logo',
        'active'
    ];
}
