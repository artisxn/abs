<?php

namespace App\Http\Controllers\Feature\Game;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Jobs\Feature\UpdateJob;

class GameController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        //        $best_sellers = $repository->bestSellers(637394);

        //        $pre_orders = $repository->preOrder(637394);
        try {
            $pre_orders = cache('feature.pre_order.637394');
        } catch (\Exception $e) {
            logger()->error($e);
        }

        if (empty($pre_orders)) {
            UpdateJob::dispatch();
        }

        return view('feature.game.index')->with(compact([
            //            'best_sellers',
            'pre_orders',
        ]));
    }
}
