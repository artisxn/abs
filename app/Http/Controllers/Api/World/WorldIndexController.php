<?php

namespace App\Http\Controllers\Api\World;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\Api\WorldItem as WorldItemResource;

use App\Repository\WorldItem\WorldItemRepositoryInterface as WorldItem;

class WorldIndexController extends Controller
{
    /**
     * @param Request   $request
     * @param WorldItem $repository
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, WorldItem $repository)
    {
        $items = $repository->apiIndex();

        return WorldItemResource::collection($items);
    }
}
