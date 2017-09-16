<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use AmazonProduct;

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
        $lists = collect(config('amazon-browse'));
        $browse = $lists->random();

        $browse_items = $service->browse($browse);

        return view('home.index')->with($browse_items);
    }
}
