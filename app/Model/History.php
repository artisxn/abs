<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'asin_id',
        'rank',
        'day',
        'offer',
        'lowest_new_price',
        'lowest_used_price',
        'availability',
        'total_new',
        'total_used',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'offer' => 'array',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'day',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo(Item::class, 'asin_id', 'asin');
    }

    public function getLowestNewPriceAttribute($value)
    {
        if (!empty($value)) {
            $value = '￥ ' . number_format($value);
        }

        return $value;
    }

    public function getLowestUsedPriceAttribute($value)
    {
        if (!empty($value)) {
            $value = '￥ ' . number_format($value);
        }

        return $value;
    }
}
