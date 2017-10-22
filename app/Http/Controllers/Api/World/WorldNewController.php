<?php

namespace App\Http\Controllers\Api\World;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\WorldItem;

use App\Http\Resources\Api\WorldItem as WorldItemResource;

class WorldNewController extends Controller
{
    public function __invoke(Request $request)
    {
        $items = WorldItem::latest()
                          ->with(['availability', 'binding', 'browses'])
                          ->when($request->filled('since'), function ($query) use ($request) {
                              return $query->whereDate('created_at', '>=', $request->input('since'));
                          })
                          ->when($request->filled('country'), function ($query) use ($request) {
                              return $query->whereIn('country', explode(',', $request->input('country')));
                          })->paginate($request->input('limit', 10));

        return WorldItemResource::collection($items);
    }
}
