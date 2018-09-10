<?php

declare (strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserMeta
 * @package App
 */
class UserMeta extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'address',
    ];
}
