<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Jobs\SearchJob;

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

        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
        } else {
            $keyword = 'amazon';
        }

        $page = $request->input('page', 1);

        $search_result = dispatch_now(new SearchJob($category, $keyword, $page));

        return view('search.search')->with($search_result);
    }
}
