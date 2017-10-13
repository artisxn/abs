<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Binding extends Model
{
    protected $fillable = [
        'binding',
    ];

    public function world_items()
    {
        return $this->hasMany(WorldItem::class);
    }
}
