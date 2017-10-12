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
        'lowest_used_price',
        'availability',
        'total_new',
        'total_used',
        'editorial_review',
    ];
}
