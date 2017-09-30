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

        $authors = array_get($this->attributes, 'Author');
        if (is_array($authors)) {
            $authors = implode(',', $authors);
        }

        $creators = array_get($this->attributes, 'Creator');
        if (is_array($creators)) {
            $creators = implode(',', $creators);
        }

        $actors = array_get($this->attributes, 'Actor');
        if (is_array($actors)) {
            $actors = implode(',', $actors);
        }

        return [
            $this->asin,
            $this->title,
            $this->rank,
            array_get($this->attributes, 'Binding'),
            array_get($this->attributes, 'Brand'),
            array_get($this->attributes, 'Publisher'),
            $authors,
            $creators,
            $actors,
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
