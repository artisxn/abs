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
            //            sleep(1);

            return rescue(function () use ($asin) {
                $results = AmazonProduct::item($asin);
                $item = array_get($results, 'Items.Item');

                $this->createItem($item);

                return $item;
            }, function () use ($asin) {
                logger()->error('ASIN Error: ' . $asin);

                return [];
            });
        });

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


        $new_item = Item::updateOrCreate([
            'asin' => $asin,
        ], [
            'asin'   => $asin,
            'title'  => $title,
            'browse' => $item,
        ]);

        $browse_nodes = $this->browseNodes($item);

        $new_item->browses()->sync($browse_nodes);

        $this->createHistory($item);
    }

    /**
     * @param array $item
     */
    private function createHistory(array $item)
    {
        $asin = array_get($item, 'ASIN');

        $rank = array_get($item, 'SalesRank');

        $availability = array_get($item, 'Offers.Offer.OfferListing.Availability');
        $lowest_new_price = array_get($item, 'OfferSummary.LowestNewPrice.Amount');
        $lowest_used_price = array_get($item, 'OfferSummary.LowestUsedPrice.Amount');
        $total_new = array_get($item, 'OfferSummary.TotalNew');
        $total_used = array_get($item, 'OfferSummary.TotalUsed');

        $history = History::updateOrCreate([
            'asin_id' => $asin,
            'day'     => today(),
        ], [
            'asin_id'           => $asin,
            'day'               => today(),
            'rank'              => $rank,
            //            'offer'             => $offer,
            'availability'      => $availability,
            'lowest_new_price'  => $lowest_new_price,
            'lowest_used_price' => $lowest_used_price,
            'total_new'         => $total_new,
            'total_used'        => $total_used,
        ]);
    }

    /**
     * @param array $item
     *
     * @return array
     */
    private function browseNodes(array $item)
    {
        $ids = [];
        $browsenodes = array_get($item, 'BrowseNodes');

        while ($browsenodes = array_get($browsenodes, 'BrowseNode')) {
            if (!array_has($browsenodes, 'BrowseNodeId')) {
                $browsenodes = head($browsenodes);
            }

            $ids[] = (int)array_get($browsenodes, 'BrowseNodeId');

            $browsenodes = array_get($browsenodes, 'Ancestors');
        }

        return $ids;
    }
}
