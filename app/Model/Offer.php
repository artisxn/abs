<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'item_asin',
        'offers',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'offers' => 'array',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
