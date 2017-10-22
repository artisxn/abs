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

        $asin_item = $repository->show($asin);

        //APIで取得失敗かつ保存済データもない場合
        if (empty($asin_item)) {
            $alert_message = true;

            return view('asin.show')->with(compact('alert_message'));
        }

        //取得失敗した場合は後で再取得
        if (empty($item)) {
            ItemJob::dispatch($asin)->delay(now()->addMinutes(5));

            //保存済データを使用
            $item = [
                'ASIN'           => $asin,
                'SalesRank'      => $asin_item->rank,
                'DetailPageURL'  => $asin_item->detail_url,
                'ItemAttributes' => $asin_item->item_attribute->attributes,
                'OfferSummary'   => $asin_item->offer_summary->offer_summary,
                'Offers'         => $asin_item->offers->offers,
                'ImageSets'      => $asin_item->image_sets->image_sets,
            ];
        }

        return view('asin.show')->with(compact('item', 'asin_item'));
    }
}
