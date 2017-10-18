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
            'id'                => $this->id,
            'asin'              => $this->asin,
            'ean'               => $this->ean,
            'country'           => $this->country,
            'title'             => $this->title,
            'rank'              => $this->rank,
            'availability'      => $this->availability->availability,
            'binding'           => $this->binding->binding,
            'lowest_new_price'  => $this->lowest_new_price,
            'lowest_used_price' => $this->lowest_used_price,
            'total_new'         => $this->total_new,
            'total_used'        => $this->total_used,
            'editorial_review'  => $this->editorial_review,
            'created_at'        => (string)$this->created_at,
            'updated_at'        => (string)$this->updated_at,
        ];
    }
}
