<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\WorldItem;

use App\Http\Resources\Api\WorldItem as WorldItemResource;

class WorldController extends Controller
{
    /**
     * WorldController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_unless(auth()->check(), 404, 'Not Found');

        $items = auth()->user()->worldItems()
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

    /**
     * @param Request $request
     * @param         $asin
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $asin)
    {
        $item = WorldItem::whereAsin($asin)
                         ->with(['availability', 'binding', 'browses'])
                         ->when($request->has('country'), function ($query) use ($request) {
                             return $query->filled('country', explode(',', $request->input('country')));
                         })->get();

        abort_if($item->isEmpty(), 404, 'Not Found');

        return WorldItemResource::collection($item);
    }
}
