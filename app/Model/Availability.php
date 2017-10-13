<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    protected $fillable = [
        'availability',
    ];

    public function histories()
    {
        return $this->hasMany(History::class);
    }

    public function worldItems()
    {
        return $this->hasMany(WorldItem::class);
    }
}
