<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\Resource;

class WorldItem extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                   => $this->id,
            'asin'                 => $this->asin,
            'ean'                  => $this->ean,
            'country'              => $this->country,
            'title'                => abs_decode($this->title),
            'rank'                 => $this->rank,
            'availability'         => abs_decode($this->availability->availability),
            'binding'              => abs_decode($this->binding->binding),
            'browses'              => $this->browses->reverse()->pluck('id', 'title'),
            'description'          => (string)abs_decode($this->editorial_review),
            'new_price'            => $this->lowest_new_price,
            'new_price_formatted'  => (string)abs_decode($this->lowest_new_formatted_price),
            'used_price'           => $this->lowest_used_price,
            'used_price_formatted' => (string)abs_decode($this->lowest_used_formatted_price),
            'total_new'            => $this->total_new,
            'total_used'           => $this->total_used,
            'quantity'             => (int)$this->quantity,
            'created_at'           => (string)$this->created_at,
            'updated_at'           => (string)$this->updated_at,
        ];
    }
}
