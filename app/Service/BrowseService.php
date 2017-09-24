<?php

namespace App\Service;

use AmazonProduct;

use App\Model\Browse;

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

        if (empty($result)) {
            return [
                'browse_name'  => '',
                'browse_items' => [],
                'browse_id'    => $browse,
            ];
        }

        $nodes = array_get($result, 'BrowseNodes');

        $browse_name = array_get($nodes, 'BrowseNode.Name');


        $sellers = array_get($nodes, 'BrowseNode.TopSellers.TopSeller');

        if (empty($sellers)) {
            return [
                'browse_name'  => $browse_name,
                'browse_items' => [],
                'browse_id'    => $browse,
            ];
        }


        $br = Browse::updateOrCreate([
            'id' => $browse,
        ], [
            'id'    => $browse,
            'title' => $browse_name,
        ]);

        $asin = array_pluck($sellers, 'ASIN');

        $results = cache()->remember('items.' . implode('.', $asin), 60, function () use ($asin) {
            return AmazonProduct::items($asin);
        });

        $items = array_get($results, 'Items.Item');

        return [
            'browse_name'  => $browse_name,
            'browse_items' => $items,
            'browse_id'    => $browse,
        ];
    }
}
