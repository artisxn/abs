<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Service\BrowseService;

class BrowseController extends Controller
{
    /**
     * @param BrowseService $service
     * @param string $browse
     *
     * @return \Illuminate\Http\Response
     */
    public function browse(BrowseService $service, string $browse)
    {
        $browse_items = $service->browse($browse);

        return view('browse.index')->with($browse_items);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function browseList()
    {
        $lists = config('amazon-browse');

        return view('browse.list')->with(compact('lists'));
    }
}
