<?php

namespace App\Http\Controllers\Browse;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Jobs\BrowseJob;

class BrowseNewController extends Controller
{
    /**
     * Browse New Release
     *
     * @param string $browse
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(string $browse)
    {
        $browse_items = dispatch_now(new BrowseJob($browse, 'NewReleases'));

        $browse_items = array_add($browse_items, 'browse_new', '（ニューリリース）');

        return view('browse.index')->with($browse_items);
    }
}
