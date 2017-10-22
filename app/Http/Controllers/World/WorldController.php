<?php

namespace App\Http\Controllers\World;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\WorldItem;

class WorldController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $world_items = $request->user()
                               ->worldItems()
                               ->with(['availability', 'binding', 'browses'])
                               ->latest('updated_at')
                               ->when($request->filled('search'), function ($query) use ($request) {
                                   return $query->where('title', 'LIKE', '%' . $request->input('search') . '%');
                               })
                               ->paginate(100);

        return view('world.index')->with(compact('world_items'));
    }

    /**
     * @param string $asin
     *
     * @return \Illuminate\Http\Response
     */
    public function show($asin)
    {
        $world_items = WorldItem::whereAsin($asin)
                                ->with(['availability', 'binding', 'browses'])
                                ->get();

        return view('world.show')->with(compact('world_items'));
    }
}
