<?php

namespace App\Repository\Item\Traits;

use App\Model\Availability;
use App\Model\ItemAttribute;
use App\Model\OfferSummary;
use App\Model\Offer;
use App\Model\ImageSet;

trait Create
{
    /**
     * @inheritDoc
     */
    public function create(array $item = null)
    {
        $asin = array_get($item, 'ASIN');

        if (empty($asin)) {
            return null;
        }

        $rank = array_get($item, 'SalesRank');
        $title = abs_decode(array_get($item, 'ItemAttributes.Title'));
        $large_image = array_get($item, 'LargeImage.URL');
        $detail_url = array_get($item, 'DetailPageURL');

        //        info($title);

        $new_item = $this->updateOrCreate([
            'asin' => $asin,
        ], compact([
            'title',
            'rank',
            'large_image',
            'detail_url',
        ]));

        //Availability
        $availability = abs_decode(array_get($item, 'Offers.Offer.OfferListing.Availability', ''));
        $ava = Availability::firstOrCreate(compact('availability'));
        $new_item->availability()->associate($ava)->save();

        //ItemAttribute
        if (config('feature.save_item_attributes')) {
            $attributes = array_get($item, 'ItemAttributes');
            if (!empty($attributes)) {
                $attr = ItemAttribute::updateOrCreate([
                    'item_asin' => $asin,
                ], [
                    'attributes' => $attributes,
                ]);
            }
        }

        //OfferSummary
        if (config('feature.save_offer_summary')) {
            $offer_summary = array_get($item, 'OfferSummary');
            if (!empty($offer_summary)) {
                $summary = OfferSummary::updateOrCreate([
                    'item_asin' => $asin,
                ], [
                    'offer_summary' => $offer_summary,
                ]);
            }
        }

        //Offers
        if (config('feature.save_offers')) {
            $offers = array_get($item, 'Offers');
            if (!empty($offers)) {
                $offer = Offer::updateOrCreate([
                    'item_asin' => $asin,
                ], [
                    'offers' => $offers,
                ]);
            }
        }

        //ImageSet
        if (config('feature.save_image_sets')) {
            $image_sets = array_get($item, 'ImageSets');
            if (!empty($image_sets)) {
                $image = ImageSet::updateOrCreate([
                    'item_asin' => $asin,
                ], [
                    'image_sets' => $image_sets,
                ]);
            }
        }

        return $new_item;
    }
}
