<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WorldItem extends Model
{
    use Presenter\PriceFormatTrait;

    /**
     * @var array
     */
    protected $fillable = [
        'asin',
        'ean',
        'country',
        'title',
        'rank',
        'lowest_new_price',
        'lowest_new_formatted_price',
        'lowest_used_price',
        'lowest_used_formatted_price',
        'total_new',
        'total_used',
        'quantity',
        'editorial_review',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'availability_id',
        'binding_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function binding()
    {
        return $this->belongsTo(Binding::class)->withDefault();
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
}
