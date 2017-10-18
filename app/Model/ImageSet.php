<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ImageSet extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'item_asin',
        'image_sets',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'image_sets' => 'array',
    ];

    /**
     * @var array
     */
    protected $touches = ['item'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
