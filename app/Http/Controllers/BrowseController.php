<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use AmazonProduct;

class BrowseController extends Controller
{
    /**
     * @param string $browse
     *
     * @return \Illuminate\Http\Response
     */
    public function browse(string $browse)
    {
        $result = AmazonProduct::browse($browse);

        $nodes = array_get($result, 'BrowseNodes');
        $browse_name = array_get($nodes, 'BrowseNode.Name');

        $items = array_get($nodes, 'BrowseNode.TopSellers.TopSeller');
        $items = collect($items)->pluck('ASIN');
        $results = AmazonProduct::items($items->toArray());

        $items = array_get($results, 'Items.Item');

        return view('browse.index')->with(compact('items', 'browse_name', 'browse'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function browseList()
    {
        $lists = config('amazon-browse');

        return view('browse.list')->with(compact('lists'));
    }
}
