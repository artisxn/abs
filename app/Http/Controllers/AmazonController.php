<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Service\BrowseService;

use App\Model\Item;
use App\Model\History;
use App\Model\Browse;

class AmazonController extends Controller
{
    /**
     * @param BrowseService $service
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BrowseService $service)
    {
        $lists = collect(config('amazon-browse'));
        $browse = $lists->random();

        $browse_items = $service->browse($browse);

        $browse_items = array_merge($browse_items, [
            'items_count'     => Item::count('asin'),
            'histories_count' => History::count('id'),
            'browses_count'   => Browse::count('id'),
        ]);

        return view('home.index')->with($browse_items);
    }
}
