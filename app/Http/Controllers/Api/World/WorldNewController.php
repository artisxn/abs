<?php

namespace App\Http\Controllers\Api\World;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\Api\WorldItem as WorldItemResource;

use App\Repository\WorldItem\WorldItemRepositoryInterface as WorldItem;

class WorldNewController extends Controller
{
    /**
     * @param Request   $request
     * @param WorldItem $repository
     *
     * @return mixed
     */
    public function __invoke(Request $request, WorldItem $repository)
    {
        $items = $repository->apiNew();

        return WorldItemResource::collection($items);
    }
}
