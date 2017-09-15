<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use AmazonProduct;

class AmazonController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = collect(config('amazon-browse'));
        $node = $lists->random();

        return $this->browse($node);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $category = $request->input('category', 'All');
        $keyword = $request->input('keyword', 'amazon');
        $page = $request->input('page', 1);

        $results = AmazonProduct::search($category, $keyword, $page);

        $item = array_get($results, 'Items');

        $TotalResults = array_get($item, 'TotalResults');
        if ($TotalResults === 1) {
            $items = [array_get($item, 'Item')];
        } else {
            $items = array_get($item, 'Item');
        }

        $TotalPages = array_get($item, 'TotalPages');

        $MoreSearchResultsUrl = array_get($item, 'MoreSearchResultsUrl');
        if (!empty($MoreSearchResultsUrl)) {
            session(['MoreSearchResultsUrl' => $MoreSearchResultsUrl]);
        }

        return view('home.search')->with(compact(
            'items',
            'page',
            'TotalResults',
            'TotalPages'
        ));
    }

    /**
     * @param string $asin
     *
     * @return \Illuminate\Http\Response
     */
    public function asin($asin)
    {
        $item = cache()->remember('asin.' . $asin, 60, function () use ($asin) {
            $results = AmazonProduct::item($asin);
            $item = array_get($results, 'Items.Item');

            return $item;
        });

        return view('home.asin')->with(compact('item'));
    }

    /**
     * @param string $browse
     *
     * @return \Illuminate\Http\Response
     */
    public function browse($browse)
    {
        $result = AmazonProduct::browse($browse);

        $nodes = array_get($result, 'BrowseNodes');
        $browse_name = array_get($nodes, 'BrowseNode.Name');

        $items = array_get($nodes, 'BrowseNode.TopSellers.TopSeller');
        $items = collect($items)->pluck('ASIN');
        $results = AmazonProduct::items($items->toArray());

        $items = array_get($results, 'Items.Item');

        return view('home.browse')->with(compact('items', 'browse_name', 'browse'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function browseList()
    {
        $lists = config('amazon-browse');

        return view('home.list')->with(compact('lists'));
    }
}
