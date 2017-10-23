<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $primaryKey = 'asin';

    public $incrementing = false;

    protected $fillable = [
        'asin',
        'title',
        'rank',
        'large_image',
        'detail_url',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function histories()
    {
        return $this->hasMany(History::class, 'asin_id', 'asin');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function watches()
    {
        return $this->hasMany(Watch::class, 'asin_id', 'asin');
    }

    /**
     * ウォッチリストに入れてるユーザー
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function users()
    {
        return $this->hasManyThrough(
            User::class,
            Watch::class,
            'asin_id',
            'id',
            'asin',
            'user_id'
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function browses()
    {
        return $this->belongsToMany(Browse::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function availability()
    {
        return $this->belongsTo(Availability::class)->withDefault();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function item_attribute()
    {
        return $this->hasOne(ItemAttribute::class)->withDefault();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function offers()
    {
        return $this->hasOne(Offer::class)->withDefault();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function offer_summary()
    {
        return $this->hasOne(OfferSummary::class)->withDefault();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function image_sets()
    {
        return $this->hasOne(ImageSet::class)->withDefault();
    }
}
