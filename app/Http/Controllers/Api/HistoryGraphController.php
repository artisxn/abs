<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\Api\HistoryGraph;
use App\Repository\Item\ItemRepositoryInterface as Item;

class HistoryGraphController extends Controller
{
    /**
     *
     * @param Request $request
     * @param Item    $repository
     * @param string  $asin
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Item $repository, string $asin)
    {
        $limit = $request->input('limit', 365);

        $histories = $repository->histories($asin, $limit);

        return HistoryGraph::collection($histories);
    }
}
