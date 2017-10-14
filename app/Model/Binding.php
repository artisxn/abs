<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Binding extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'binding',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function world_items()
    {
        return $this->hasMany(WorldItem::class);
    }
}
