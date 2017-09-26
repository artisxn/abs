<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Service\BrowseService;

class AmazonController extends Controller
{
    /**
     * @param BrowseService $service
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BrowseService $service)
    {
        $browse_items = cache()->remember('random_items', 30, function () use ($service) {
            $lists = collect(config('amazon-browse'));
            $browse = $lists->random();

            return $service->browse($browse);
        });

        return view('home.index')->with($browse_items);
    }
}
