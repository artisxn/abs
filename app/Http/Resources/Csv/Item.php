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
        $image = '';
        $image_sets = array_get($this->browse, 'ImageSets.ImageSet');
        if (!empty($image_sets)) {
            foreach ($image_sets as $image_set) {
                if (array_has($image_set, 'HiResImage')) {
                    $image .= array_get($image_set, 'HiResImage.URL') . ',';
                }
            }
        }

        return [
            $this->asin,
            $this->title,
            array_get($this->browse, 'ItemAttributes.Binding'),
            array_get($this->browse, 'ItemAttributes.Brand'),
            array_get($this->browse, 'ItemAttributes.Publisher'),
            array_get($this->browse, 'ItemAttributes.ReleaseDate'),
            array_get($this->browse, 'OfferSummary.LowestNewPrice.Amount'),
            array_get($this->browse, 'OfferSummary.TotalNew'),
            array_get($this->browse, 'OfferSummary.LowestUsedPrice.Amount'),
            array_get($this->browse, 'OfferSummary.TotalUsed'),
            array_get($this->browse, 'Offers.Offer.OfferListing.Availability'),

            $this->updated_at,

            array_get($this->browse, 'LargeImage.URL'),
            $image,

            array_get($this->browse, 'DetailPageURL'),
        ];
    }
}
