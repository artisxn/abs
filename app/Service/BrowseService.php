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
            sleep(1);

            return rescue(function () use ($browse, $response) {
                return AmazonProduct::browse($browse, $response);
            }, function () use ($browse) {
                logger()->error('Browse Error: ' . $browse);

                return [];
            });
        });

        if (empty($result)) {
            cache()->delete($cache_key);

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
            cache()->delete($cache_key);

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

        $cache_key_asin = 'items.' . implode('.', $asin);
        $results = cache()->remember($cache_key_asin, 60, function () use ($asin) {
            sleep(1);

            return rescue(function () use ($asin) {
                return AmazonProduct::items($asin);
            }, function () {
                logger()->error('Browse Error: asin');

                return [];
            });
        });

        if (empty($results)) {
            cache()->delete($cache_key_asin);
        }

        $browse_items = array_get($results, 'Items.Item');

        return [
            'browse_name'  => $browse_name,
            'browse_items' => $browse_items,
            'browse_id'    => $browse,
        ];
    }
}
