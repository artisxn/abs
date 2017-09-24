<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BrowseWatch extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'browse_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function browse()
    {
        return $this->belongsTo(Browse::class);
    }
}
