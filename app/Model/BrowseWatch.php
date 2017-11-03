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

    /**
     * @var array
     */
    protected $hidden = [
        'user_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function browse()
    {
        return $this->belongsTo(Browse::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function browseItems()
    {
        return $this->hasMany(BrowseItem::class, 'browse_id', 'browse_id');
    }
}
