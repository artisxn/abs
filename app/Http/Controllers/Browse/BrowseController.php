<?php

namespace App\Http\Controllers\Browse;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Jobs\BrowseJob;

class BrowseController extends Controller
{
    /**
     * Browse TopSellers
     *
     * @param string $browse
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(string $browse)
    {
        $browse_items = dispatch_now(new BrowseJob($browse));

        return view('browse.index')->with($browse_items);
    }
}
