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
}
