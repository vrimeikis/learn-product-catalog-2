<?php

declare (strict_types=1);

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserMeta
 *
 * @package App
 * @property int $id
 * @property int $user_id
 * @property string $address
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|UserMeta whereAddress($value)
 * @method static Builder|UserMeta whereCreatedAt($value)
 * @method static Builder|UserMeta whereId($value)
 * @method static Builder|UserMeta whereUpdatedAt($value)
 * @method static Builder|UserMeta whereUserId($value)
 * @mixin \Eloquent
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
