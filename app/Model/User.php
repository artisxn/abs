<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use NotificationChannels\WebPush\HasPushSubscriptions;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;
    use HasPushSubscriptions;
    use Presenter\PlanTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'user_id',
        'access_token',
        'refresh_token',
        'special_key',
        'api_token',
        'notify_mail',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'access_token',
        'refresh_token',
        'special_key',
        'api_token',
        'notify_mail',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function watches()
    {
        return $this->hasMany(Watch::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function browseWatches()
    {
        return $this->hasMany(BrowseWatch::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function worldItems()
    {
        return $this->hasManyThrough(
            WorldItem::class,
            Watch::class,
            'user_id',
            'asin',
            'id',
            'asin_id'
        );
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role_id === 1;
    }
}
