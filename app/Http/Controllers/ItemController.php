<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use AmazonProduct;

use App\Model\Item;
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
        //         特定カテゴリーのアイテムリスト
        //        $i = Item::has('histories')->where('browse', 'LIKE', '%"BrowseNodeId": "___"%')->get();
        //        $i->load([
        //            'histories' => function ($query) {
        //                $query->orderBy('day', 'desc')->take(2);
        //            },
        //        ]);
        //        dd($i);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  string $asin
     *
     * @return \Illuminate\Http\Response
     */
    public function show(string $asin)
    {
        $item = cache()->remember('asin.' . $asin, 60, function () use ($asin) {
            $results = AmazonProduct::item($asin);
            $item = array_get($results, 'Items.Item');

            $this->createItem($item);

            return $item;
        });

        /**
         * @var \Illuminate\Support\Collection $histories
         */
        $histories = History::whereAsinId($asin)
                            ->whereNotNull('offer')
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

    /**
     * @param array|null $item
     */
    public function createItem(array $item = null)
    {
        if (is_null($item)) {
            return;
        }

        $asin = array_get($item, 'ASIN');
        $title = array_get($item, 'ItemAttributes.Title');

        $rank = array_get($item, 'SalesRank');

        $offer = array_get($item, 'OfferSummary');

        $new_item = Item::updateOrCreate([
            'asin' => $asin,
        ], [
            'asin'   => $asin,
            'title'  => $title,
            'browse' => $item,
        ]);

        $history = History::updateOrCreate([
            'asin_id' => $asin,
            'day'     => today(),
        ], [
            'asin_id' => $asin,
            'day'     => today(),
            'rank'    => $rank,
            'offer'   => $offer,
        ]);
    }
}
