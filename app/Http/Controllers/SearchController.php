<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use AmazonProduct;

class SearchController extends Controller
{
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

        //1件の場合は
        if ($TotalResults === '1') {
            $items = [array_get($item, 'Item')];
        } else {
            $items = array_get($item, 'Item');
        }

        $TotalPages = array_get($item, 'TotalPages');

        $MoreSearchResultsUrl = array_get($item, 'MoreSearchResultsUrl');
        if (!empty($MoreSearchResultsUrl)) {
            session(['MoreSearchResultsUrl' => $MoreSearchResultsUrl]);
        }

        return view('search.search')->with(compact(
            'items',
            'page',
            'TotalResults',
            'TotalPages'
        ));
    }
}
