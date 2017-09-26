<?php

namespace App\Http\Resources\Csv;

use Illuminate\Http\Resources\Json\Resource;

class Item extends Resource
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
        $images = [];
        $image_sets = array_get($this->image_sets, 'ImageSet');
        if (!empty($image_sets)) {
            foreach ($image_sets as $image_set) {
                if (array_has($image_set, 'HiResImage')) {
                    $images[] = array_get($image_set, 'HiResImage.URL');
                }
            }
        }

        return [
            $this->asin,
            $this->title,
            array_get($this->attributes, 'Binding'),
            array_get($this->attributes, 'Brand'),
            array_get($this->attributes, 'Publisher'),
            array_get($this->attributes, 'ReleaseDate'),
            array_get($this->offer_summary, 'LowestNewPrice.Amount'),
            array_get($this->offer_summary, 'TotalNew'),
            array_get($this->offer_summary, 'LowestUsedPrice.Amount'),
            array_get($this->offer_summary, 'TotalUsed'),
            array_get($this->offers, 'Offer.OfferListing.Availability'),

            $this->updated_at,

            $this->large_image,
            implode(',', $images),

            $this->detail_url,
        ];
    }
}
