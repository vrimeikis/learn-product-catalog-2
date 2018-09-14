<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Feature
 * @package App
 */
class Feature extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'active',
    ];

    /**
     * @return BelongsToMany
     */
    public function featureItems(): BelongsToMany
    {
        return $this->belongsToMany(FeatureItem::class);
    }
}

