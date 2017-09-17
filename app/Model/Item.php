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
    ];

    public function histories()
    {
        return $this->hasMany(History::class, 'asin_id', 'asin');
    }

    public function watches()
    {
        return $this->hasMany(Watch::class, 'asin_id', 'asin');
    }
}
