<?php

namespace App\Http\Controllers\Api\World;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\WorldItem;

use App\Jobs\World\WorldWatchJob;
use App\Http\Resources\Api\WorldItem as WorldItemResource;

use App\Http\Requests\World\WorldUpdateRequest;

class WorldUpdateController extends Controller
{
    /**
     * @param WorldUpdateRequest $request
     *
     * @return mixed
     */
    public function __invoke(WorldUpdateRequest $request)
    {
        $asins = explode(',', $request->input('asin', ''));
        $country = $request->input('country', 'JP');

        abort_if(blank($asins), 400, 'Bad Request');

        abort_if(blank($country), 400, 'Bad Request');

        dispatch_now(new WorldWatchJob($asins, $country));

        $item = WorldItem::whereIn('asin', $asins)
                         ->latest('updated_at')
                         ->with(['availability', 'binding', 'browses'])
                         ->whereCountry($country)
                         ->get();

        abort_if($item->isEmpty(), 404, 'Not Found');

        return WorldItemResource::collection($item);
    }
}
