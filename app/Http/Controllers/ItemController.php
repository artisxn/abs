<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Jobs\ItemJob;

use App\Repository\Item\ItemRepositoryInterface as Item;

class ItemController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param Item   $repository
     * @param string $asin
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Item $repository, string $asin)
    {
        $item = dispatch_now(new ItemJob($asin));

        abort_if(empty($item), 503);

        $asin_item = $repository->show($asin);

        return view('asin.show')->with(compact('item', 'asin_item'));
    }
}
