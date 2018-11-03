<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;

class Post extends \TCG\Voyager\Models\Post
{
    use Notifiable;

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

    public function routeNotificationForDiscord()
    {
        return config('services.discord.channel');
    }
}
