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
        $browse_items = cache()->remember('random_items', 10, function () use ($service) {
            $lists = collect(config('amazon-browse'));
            $browse = $lists->random();

            return $service->browse($browse);
        });

        $recent_items = cache()->remember('recent_items', 60, function () {
            return Item::latest('updated_at')->take(12)->get();
        });

        $count_info = cache()->remember('count_info', 60, function () {
            return [
                'items_count'     => Item::count('asin'),
                'histories_count' => History::count('id'),
                'browses_count'   => Browse::count('id'),
            ];
        });

        $browse_items = array_merge($browse_items,
            $count_info, [
                'recent_items' => $recent_items,
            ]);

        return view('home.index')->with($browse_items);
    }
}
