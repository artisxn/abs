<?php

namespace App\Http\Controllers\Watch;

use App\Http\Controllers\Controller;

use App\Model\Watch;
use Illuminate\Http\Request;

class WatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $asin_watches = $request->user()
                                ->watches()
                                ->with(['item'])
                                ->latest()
                                ->get();

        $browse_watches = $request->user()
                                  ->browseWatches()
                                  ->with(['browse'])
                                  ->withCount('browseItems')
                                  ->latest()
                                  ->get();

        return view('watch.index')->with(compact('asin_watches', 'browse_watches'));
    }
}
