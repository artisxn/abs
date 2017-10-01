<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\Resource;

class HistoryGraph extends Resource
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
            'day'               => $this->day,
            'rank'              => $this->rank,
            'lowest_new_price'  => $this->lowest_new_price,
            'lowest_used_price' => $this->lowest_used_price,
            'total_new'         => $this->total_new,
            'total_used'        => $this->total_used,
        ];
    }
}
