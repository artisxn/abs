<?php

namespace App\Http\Controllers\World;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WorldNewController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $world_items = $request->user()
                               ->worldItems()
                               ->with(['availability', 'binding', 'browses'])
                               ->latest()
                               ->paginate(100);

        return view('world.new')->with(compact('world_items'));
    }
}
