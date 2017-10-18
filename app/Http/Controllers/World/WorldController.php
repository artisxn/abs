<?php

namespace App\Http\Controllers\World;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\WorldItem;

class WorldController extends Controller
{
    public function __construct()
    {
        $this->middleware('world');
    }

    public function index(Request $request)
    {
        $world_items = $request->user()
                               ->worldItems()
                               ->with(['availability'])
                               ->latest('updated_at')
                               ->paginate(100);

        //        dd($world_items->groupBy('asin'));

        return view('world.index')->with(compact('world_items'));
    }

    public function show($asin)
    {
        $item = WorldItem::whereAsin($asin)->get();
        dd($item);
    }
}
