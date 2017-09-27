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

        abort_if(empty($item), 404);

        $asin_item = Item::findOrFail($asin);

        $asin_item->load([
            'histories' => function ($query) {
                $query->latest()->limit(30);
            },
        ]);

        //TODO: データが増えたらグラフ等を表示
        //        dd($histories);
        //平均ランク
        //        dd($histories->avg('rank'));
        //新品平均価格
        //        dd($histories->avg('offer.LowestNewPrice.Amount'));
        //新品価格グラフ用
        //        dd($histories->pluck('offer.LowestNewPrice.Amount'));
        //中古平均価格
        //        dd($histories->avg('offer.LowestUsedPrice.Amount'));
        //中古価格グラフ用
        //        dd($histories->pluck('offer.LowestUsedPrice.Amount'));

        return view('asin.show')->with(compact('item', 'asin_item'));
    }
}
