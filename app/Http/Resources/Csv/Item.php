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

        $image_sets = array_get($this->image_sets->image_sets, 'ImageSet');
        if (!empty($image_sets)) {
            foreach ($image_sets as $image_set) {
                if (array_has($image_set, 'HiResImage')) {
                    $images[] = array_get($image_set, 'HiResImage.URL');
                }
            }
        }

        $attr = $this->item_attribute->attributes;

        $authors = array_get($attr, 'Author');
        if (is_array($authors)) {
            $authors = implode(',', $authors);
        }

        $creators = array_get($attr, 'Creator');
        if (is_array($creators)) {
            $creators = implode(',', $creators);
        }

        $actors = array_get($attr, 'Actor');
        if (is_array($actors)) {
            $actors = implode(',', $actors);
        }

        $offer_summary = $this->offer_summary->offer_summary;

        return [
            $this->asin,
            $this->title,
            $this->rank,
            array_get($attr, 'Binding'),
            array_get($attr, 'Brand'),
            array_get($attr, 'Publisher'),
            $authors,
            $creators,
            $actors,
            array_get($attr, 'ReleaseDate'),
            array_get($offer_summary, 'LowestNewPrice.Amount'),
            array_get($offer_summary, 'TotalNew'),
            array_get($offer_summary, 'LowestUsedPrice.Amount'),
            array_get($offer_summary, 'TotalUsed'),
            array_get($this->offers->offers, 'Offer.OfferListing.Availability'),

            $this->updated_at,

            $this->large_image,
            implode(',', $images),

            $this->detail_url,
        ];
    }
}
