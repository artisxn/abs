<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends \TCG\Voyager\Models\Post
{
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
}
