<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Watch extends Model
{
    use Presenter\RankingTrait;

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

    public function histories()
    {
        return $this->hasManyThrough(
            History::class,
            Item::class,
            'asin',
            'asin_id',
            'asin_id',
            'asin'
        );
    }
}
