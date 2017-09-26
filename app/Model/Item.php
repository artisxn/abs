<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $primaryKey = 'asin';

    public $incrementing = false;

    protected $fillable = [
        'asin',
        'title',
        'attributes',
        'offer_summary',
        'offers',
        'image_sets',
        'large_image',
        'detail_url',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'attributes'    => 'array',
        'offer_summary' => 'array',
        'offers'        => 'array',
        'image_sets'    => 'array',
    ];

    public function histories()
    {
        return $this->hasMany(History::class, 'asin_id', 'asin');
    }

    public function watches()
    {
        return $this->hasMany(Watch::class, 'asin_id', 'asin');
    }

    public function browses()
    {
        return $this->belongsToMany(Browse::class);
    }
}
