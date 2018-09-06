<?php

declare (strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserMetas
 * @package App
 */
class UserMetas extends Model
{
    /**
     * @var string
     */
    protected $table = 'user_metas';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'address',
    ];
}
