<?php

namespace App\Http\Controllers\Api\World;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\Api\WorldItem as WorldItemResource;

class WorldIndexController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $items = auth()->user()
                       ->worldItems()
                       ->latest('updated_at')
                       ->with(['availability', 'binding', 'browses'])
                       ->when($request->filled('search'), function ($query) use ($request) {
                           return $query->where('title', 'LIKE', '%' . $request->input('search') . '%');
                       })
                       ->when($request->filled('country'), function ($query) use ($request) {
                           return $query->whereIn('country', explode(',', $request->input('country')));
                       })->paginate($request->input('limit', 50));

        return WorldItemResource::collection($items);
    }
}
