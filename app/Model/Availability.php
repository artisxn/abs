<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'availability',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function histories()
    {
        return $this->hasMany(History::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function worldItems()
    {
        return $this->hasMany(WorldItem::class);
    }
}
