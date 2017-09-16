<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Watch extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'asin_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'asin_id', 'asin');
    }
}
