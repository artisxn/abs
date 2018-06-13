<?php

namespace App\Http\Controllers\Feature\Game;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repository\Browse\BrowseRepositoryInterface as Browse;

class GameController extends Controller
{
    /**
     * @param Browse $repository
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Browse $repository)
    {
        //        $best_sellers = $repository->bestSellers(637394);

        $pre_orders = $repository->preOrder(637394);

        return view('feature.game.index')->with(compact([
            //            'best_sellers',
            'pre_orders',
        ]));
    }
}
