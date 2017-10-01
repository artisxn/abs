<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\Api\HistoryGraph;
use App\Model\Item;

class HistoryGraphController extends Controller
{
    /**
     *
     * @param  Request $request
     * @param  Item    $item
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Item $item)
    {
        $limit = $request->input('limit', 365);

        $histories = $item->histories()->latest('day')->limit($limit)->get();

        return HistoryGraph::collection($histories);
    }
}
