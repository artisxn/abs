<?php

namespace App\Http\Controllers\Api\World;

use App\Http\Controllers\Controller;

use App\Repository\WorldItem\WorldItemRepositoryInterface as WorldItem;

use App\Jobs\World\WorldWatchJob;
use App\Http\Resources\Api\WorldItem as WorldItemResource;

use App\Http\Requests\World\WorldUpdateRequest;

class WorldUpdateController extends Controller
{
    /**
     * @param WorldUpdateRequest $request
     * @param WorldItem          $repository
     *
     * @return mixed
     */
    public function __invoke(WorldUpdateRequest $request, WorldItem $repository)
    {
        $asins = explode(',', $request->input('asin', ''));
        $country = $request->input('country', 'JP');

        abort_if(blank($asins), 400, 'Bad Request');
        abort_if(blank($country), 400, 'Bad Request');

        dispatch_now(new WorldWatchJob($asins, $country));

        $item = $repository->apiUpdateAsins($asins, $country);

        abort_if($item->isEmpty(), 404, 'Not Found');

        return WorldItemResource::collection($item);
    }
}
