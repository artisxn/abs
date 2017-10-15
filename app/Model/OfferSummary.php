<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OfferSummary extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'item_asin',
        'offer_summary',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'offer_summary' => 'array',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
