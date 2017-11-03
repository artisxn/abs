<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Watch extends Model
{
    use Presenter\RankingTrait;

    /**
     * @var array
     */
    protected $fillable = [
        'asin_id',
        'user_id',
        'priority',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'user_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo(Item::class, 'asin_id', 'asin')->withDefault();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function histories()
    {
        return $this->hasManyThrough(
            History::class,
            Item::class,
            'asin',
            'asin_id',
            'asin_id',
            'asin'
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function worldItems()
    {
        return $this->hasMany(WorldItem::class, 'asin', 'asin_id');
    }
}
