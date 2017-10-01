<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Jobs\ItemJob;

use App\Model\Item;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  string     $asin
     *
     * @return \Illuminate\Http\Response
     */
    public function show(string $asin)
    {
        $item = dispatch_now(new ItemJob($asin));

        abort_if(empty($item), 503);

        $asin_item = Item::findOrFail($asin);

        $asin_item->load([
            'histories' => function ($query) {
                $query->latest()->limit(30);
            },
        ]);

        return view('asin.show')->with(compact('item', 'asin_item'));
    }
}
