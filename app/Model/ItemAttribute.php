<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ItemAttribute extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'item_asin',
        'attributes',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'attributes'    => 'array',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
