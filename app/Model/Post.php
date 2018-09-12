<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Notifications\Notifiable;

class Post extends Model
{
    use Notifiable;

    const PUBLISHED = 'PUBLISHED';

    /**
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePickup($query)
    {
        return $query->whereCategoryId(1)->published()->latest()->limit(3);
    }

    /**
     * Scope a query to only published scopes.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished(Builder $query)
    {
        return $query->where('status', '=', static::PUBLISHED);
    }
}
