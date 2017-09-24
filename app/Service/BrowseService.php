<?php

namespace App\Service;

use AmazonProduct;

use App\Model\Browse;

class BrowseService
{
    /**
     * @param string $browse
     * @param string $response
     *
     * @return array
     */
    public function browse(string $browse, string $response = 'TopSellers'): array
    {
        $cache_key = 'browse.' . $response . '.' . $browse;

        $result = cache()->remember($cache_key, 60, function () use ($browse, $response) {
            return AmazonProduct::browse($browse, $response);
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


        $items = array_get($nodes, 'BrowseNode.' . $response . '.' . str_singular($response));

        if (empty($items)) {
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

        $asin = array_pluck($items, 'ASIN');

        $results = cache()->remember('items.' . implode('.', $asin), 60, function () use ($asin) {
            return AmazonProduct::items($asin);
        });

        $browse_items = array_get($results, 'Items.Item');

        return [
            'browse_name'  => $browse_name,
            'browse_items' => $browse_items,
            'browse_id'    => $browse,
        ];
    }
}
