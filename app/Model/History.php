<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use Presenter\PriceFormatTrait;

    /**
     * @var array
     */
    protected $fillable = [
        'asin_id',
        'rank',
        'day',
        'lowest_new_price',
        'lowest_used_price',
        'availability',
        'total_new',
        'total_used',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo(Item::class, 'asin_id', 'asin');
    }
}
