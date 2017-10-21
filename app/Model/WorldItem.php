<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WorldItem extends Model
{
    use Presenter\PriceFormatTrait;

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
        'editorial_review',
    ];

    protected $hidden = [
        'availability_id',
        'binding_id',
    ];

    public function binding()
    {
        return $this->belongsTo(Binding::class)->withDefault();
    }

    public function browses()
    {
        return $this->belongsToMany(Browse::class);
    }

    public function availability()
    {
        return $this->belongsTo(Availability::class)->withDefault();
    }
}
