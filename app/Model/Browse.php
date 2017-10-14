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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function browseWatches()
    {
        return $this->hasMany(BrowseWatch::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function items()
    {
        return $this->belongsToMany(Item::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function browseItems()
    {
        return $this->hasMany(BrowseItem::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function worldItems()
    {
        return $this->belongsToMany(WorldItem::class);
    }
}
