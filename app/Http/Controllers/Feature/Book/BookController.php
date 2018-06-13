<?php

namespace App\Http\Controllers\Feature\Book;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repository\Browse\BrowseRepositoryInterface as Browse;

class BookController extends Controller
{
    /**
     * @param Browse $repository
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Browse $repository)
    {
        $best_sellers = $repository->bestSellers(466280);

        //        $pre_orders = $repository->preOrder(466280);

        return view('feature.book.index')->with(compact([
            'best_sellers',
            //            'pre_orders',
        ]));
    }
}
