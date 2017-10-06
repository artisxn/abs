<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Browse extends Model
{
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'title',
    ];

    public function browseWatches()
    {
        return $this->hasMany(BrowseWatch::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class);
    }

    public function browseItems()
    {
        return $this->hasMany(BrowseItem::class);
    }
}
