<?php

namespace App\Http\Controllers\World;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repository\WorldItem\WorldItemRepositoryInterface as WorldItem;

class WorldNewController extends Controller
{
    /**
     * @param Request   $request
     * @param WorldItem $repository
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, WorldItem $repository)
    {
        $world_items = $repository->newIndex();

        return view('world.new')->with(compact('world_items'));
    }
}
