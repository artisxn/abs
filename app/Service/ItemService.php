<?php

namespace App\Service;

use AmazonProduct;

use App\Model\Item;
use App\Model\History;

class ItemService
{
    /**
     * @param string $asin
     *
     * @return array
     */
    public function item(string $asin): array
    {
        $item = cache()->remember('asin.' . $asin, 60, function () use ($asin) {
            return rescue(function () use ($asin) {
                $results = AmazonProduct::item($asin);
                $item = array_get($results, 'Items.Item');

                $this->createItem($item);

                $this->createHistory($item);

                return $item;
            });
        });

        if (is_null($item)) {
            $item = [];
        }

        return $item;
    }

    /**
     * @param array|null $item
     */
    public function createItem(array $item = null)
    {
        if (empty($item)) {
            return;
        }

        $asin = array_get($item, 'ASIN');

        if (empty($asin)) {
            return;
        }

        $title = array_get($item, 'ItemAttributes.Title');
        $attributes = array_get($item, 'ItemAttributes');
        $offer_summary = array_get($item, 'OfferSummary');
        $offers = array_get($item, 'Offers');
        $image_sets = array_get($item, 'ImageSets');
        $large_image = array_get($item, 'LargeImage.URL');
        $detail_url = array_get($item, 'DetailPageURL');


        $new_item = Item::updateOrCreate([
            'asin' => $asin,
        ], compact([
            'asin',
            'title',
            'attributes',
            'offer_summary',
            'offers',
            'image_sets',
            'large_image',
            'detail_url',
        ]));

        $browse_nodes = $this->browseNodes($item);

        $new_item->browses()->sync($browse_nodes);
    }

    /**
     * @param array|null $item
     */
    private function createHistory(array $item = null)
    {
        if (empty($item)) {
            return;
        }

        $asin = array_get($item, 'ASIN');

        if (empty($asin)) {
            return;
        }

        $rank = array_get($item, 'SalesRank');

        $availability = array_get($item, 'Offers.Offer.OfferListing.Availability');
        $lowest_new_price = array_get($item, 'OfferSummary.LowestNewPrice.Amount');
        $lowest_used_price = array_get($item, 'OfferSummary.LowestUsedPrice.Amount');
        $total_new = array_get($item, 'OfferSummary.TotalNew');
        $total_used = array_get($item, 'OfferSummary.TotalUsed');

        $history = History::updateOrCreate([
            'asin_id' => $asin,
            'day'     => today(),
        ], [
            'asin_id'           => $asin,
            'day'               => today(),
            'rank'              => $rank,
            //            'offer'             => $offer,
            'availability'      => $availability,
            'lowest_new_price'  => $lowest_new_price,
            'lowest_used_price' => $lowest_used_price,
            'total_new'         => $total_new,
            'total_used'        => $total_used,
        ]);
    }

    /**
     * @param array $item
     *
     * @return array
     */
    private function browseNodes(array $item): array
    {
        $ids = [];
        $browsenodes = array_get($item, 'BrowseNodes');

        while ($browsenodes = array_get($browsenodes, 'BrowseNode')) {
            if (!array_has($browsenodes, 'BrowseNodeId')) {
                $browsenodes = head($browsenodes);
            }

            $ids[] = (int)array_get($browsenodes, 'BrowseNodeId');

            $browsenodes = array_get($browsenodes, 'Ancestors');
        }

        return $ids;
    }
}
