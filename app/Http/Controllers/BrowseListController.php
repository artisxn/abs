<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Browse;

class BrowseListController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function browseList()
    {
        $lists = config('amazon-browse');

        return view('browse.list')->with(compact('lists'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function browseAll(Request $request)
    {
        $cache_key = 'browse.list.all.' . $request->input('page', 1);

        $lists = cache()->remember($cache_key, 60, function () {
            return Browse::withCount('browseItems')
                         ->orderBy('browse_items_count', 'desc')
                         ->paginate(100);
        });

        return view('browse.list-all')->with(compact('lists'));
    }
}
