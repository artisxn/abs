<?php

namespace App\Repository\WorldItem\Traits;

use App\Model\WorldItem;
use App\Model\Binding;
use App\Model\Availability;

trait Create
{
    /**
     * @inheritDoc
     */
    public function create(array $item = null, string $country)
    {
        $asin = array_get($item, 'ASIN');

        if (empty($asin)) {
            return null;
        }

        $ean = array_get($item, 'ItemAttributes.EAN');

        $rank = array_get($item, 'SalesRank');
        $title = abs_decode(array_get($item, 'ItemAttributes.Title'));

        $lowest_new_price = array_get($item, 'OfferSummary.LowestNewPrice.Amount');
        $lowest_new_formatted_price = abs_decode(array_get($item, 'OfferSummary.LowestNewPrice.FormattedPrice'));

        $lowest_used_price = array_get($item, 'OfferSummary.LowestUsedPrice.Amount');
        $lowest_used_formatted_price = abs_decode(array_get($item, 'OfferSummary.LowestUsedPrice.FormattedPrice'));

        $total_new = array_get($item, 'OfferSummary.TotalNew');
        $total_used = array_get($item, 'OfferSummary.TotalUsed');
        $editorial_review = abs_decode(array_get($item, 'EditorialReviews.EditorialReview.Content'));

        $quantity = array_get($item, 'ItemAttributes.PackageQuantity', 1);

        /**
         * @var WorldItem $world_item
         */
        $world_item = $this->model->updateOrCreate([
            'asin'    => $asin,
            'country' => $country,
        ], compact([
            'ean',
            'title',
            'rank',
            'lowest_new_price',
            'lowest_new_formatted_price',
            'lowest_used_price',
            'lowest_used_formatted_price',
            'total_new',
            'total_used',
            'quantity',
            'editorial_review',
        ]));

        //Availability
        $availability = abs_decode(array_get($item, 'Offers.Offer.OfferListing.Availability', ''));
        $availability = str_limit($availability, 200);
        $ava = Availability::firstOrCreate(compact('availability'));
        $world_item->availability()->associate($ava);

        //Binding
        $binding = abs_decode(array_get($item, 'ItemAttributes.Binding'));

        if (!empty($binding)) {
            $bind = Binding::firstOrCreate(compact('binding'));
            $world_item->binding()->associate($bind);
        }

        $world_item->save();

        return $world_item;
    }

}
