<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Service\ItemService;

use App\Model\History;

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
     * @param ItemService $service
     * @param  string     $asin
     *
     * @return \Illuminate\Http\Response
     */
    public function show(ItemService $service, string $asin)
    {
        /**
         * @var array $item
         */
        $item = $service->item($asin);

        /**
         * @var \Illuminate\Support\Collection $histories
         */
        $histories = History::whereAsinId($asin)
                            ->latest()
                            ->limit(100)
                            ->get();

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

        return view('asin.show')->with(compact('item', 'histories'));
    }
}
