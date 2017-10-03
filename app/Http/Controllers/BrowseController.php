<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function browse(string $browse)
    {
        $browse_items = dispatch_now(new BrowseJob($browse));

        return view('browse.index')->with($browse_items);
    }

    /**
     * Browse New Release
     *
     * @param string $browse
     *
     * @return \Illuminate\Http\Response
     */
    public function newRelease(string $browse)
    {
        $browse_items = dispatch_now(new BrowseJob($browse, 'NewReleases'));

        $browse_items = array_add($browse_items, 'browse_new', '（ニューリリース）');

        return view('browse.index')->with($browse_items);
    }
}
