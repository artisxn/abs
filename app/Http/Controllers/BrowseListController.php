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
     * @param Browse  $browse
     *
     * @return \Illuminate\Http\Response
     */
    public function browseAll(Request $request, Browse $browse)
    {
        $cache_key = 'browse.list.all.' . $request->input('page', 1);

        $lists = cache()->remember($cache_key, 60 * 3, function () use ($browse) {
            return $browse->withCount('items')
                          ->orderBy('items_count', 'desc')
                          ->paginate(100);
        });

        return view('browse.list-all')->with(compact('lists'));
    }
}
