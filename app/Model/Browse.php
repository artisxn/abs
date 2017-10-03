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
     * @param int $paginate
     *
     * @return mixed
     */
    public function listAll($paginate = 100)
    {
        $cache_key = 'browse.list.all.' . request()->input('page', 1);

        $lists = cache()->remember($cache_key, 60, function () use ($paginate) {
            return $this->withCount('browseItems')
                        ->orderBy('browse_items_count', 'desc')
                        ->paginate($paginate);
        });

        return $lists;
    }

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
