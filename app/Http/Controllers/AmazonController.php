<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Cache;

use App\Service\AmazonService;

class AmazonController extends Controller
{
    /**
     * @var AmazonService
     */
    protected $amazon;

    /**
     * AmazonController constructor.
     *
     * @param AmazonService $amazon
     */
    public function __construct(AmazonService $amazon)
    {
        $this->amazon = $amazon;
    }

    /**
     * @return \Response
     */
    public function index()
    {
        $lists = collect(config('amazon.list'));
        $node = $lists->random();

        return $this->browse($node);
    }

    /**
     * @param Request $request
     *
     * @return \Response
     */
    public function search(Request $request)
    {
        $category = $request->input('category', 'All');
        $keyword = $request->input('keyword', 'amazon');
        $page = $request->input('page', 1);

        $results = $this->amazon->search($category, $keyword, $page);

        $item = $results->get('Items');

        $TotalResults = array_get($item, 'TotalResults');
        $TotalPages = array_get($item, 'TotalPages');
        $items = array_get($item, 'Item');

        $MoreSearchResultsUrl = array_get($item, 'MoreSearchResultsUrl');
        if (!empty($MoreSearchResultsUrl)) {
            session(['MoreSearchResultsUrl' => $MoreSearchResultsUrl]);
        }

        return view('home.search')->with(compact(
                                             'items',
                                             'category',
                                             'keyword',
                                             'page',
                                             'TotalResults',
                                             'TotalPages'
                                         ));
    }

    /**
     * @param string $asin
     *
     * @return \Response
     */
    public function asin($asin)
    {
        $item = Cache::remember('asin.' . $asin, 60, function () use ($asin) {
            $results = $this->amazon->item([$asin]);
            $item = $results->get('Items');
            $item = array_get($item, 'Item');

            return $item;
        });

        return view('home.asin')->with(compact('item'));
    }

    /**
     * @param string $browse
     *
     * @return \Response
     */
    public function browse($browse)
    {
        $result = $this->amazon->browse($browse);

        $nodes = $result->get('BrowseNodes');
        $browse_name = array_get($nodes, 'BrowseNode.Name');

        $items = array_get($nodes, 'BrowseNode.TopSellers.TopSeller');
        $items = collect($items)->pluck('ASIN');
        $results = $this->amazon->item($items->toArray());

        $item = $results->get('Items');

        $items = array_get($item, 'Item');

        return view('home.browse')->with(compact('items', 'browse_name', 'browse'));
    }

    /**
     * @return \Response
     */
    public function browseList()
    {
        $lists = config('amazon.list');

        return view('home.list')->with(compact('lists'));
    }
}
