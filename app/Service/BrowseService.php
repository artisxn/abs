<?php

namespace App\Service;

use AmazonProduct;

class BrowseService
{
    /**
     * @param string $browse
     *
     * @return array
     */
    public function browse(string $browse): array
    {
        $result = cache()->remember('browse.' . $browse, 60, function () use ($browse) {
            return AmazonProduct::browse($browse);
        });

        $nodes = array_get($result, 'BrowseNodes');
        $browse_name = array_get($nodes, 'BrowseNode.Name');

        $sellers = array_get($nodes, 'BrowseNode.TopSellers.TopSeller');

        $asin = collect($sellers)->pluck('ASIN');

        $results = cache()->remember('items.' . $asin->implode('.'), 60, function () use ($asin) {
            return AmazonProduct::items($asin->toArray());
        });

        $items = array_get($results, 'Items.Item');

        return [
            'browse_name' => $browse_name,
            'items'       => $items,
            'browse'      => $browse,
        ];
    }
}
