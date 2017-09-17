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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

        $histories = History::whereAsinId($asin)
                            ->whereNotNull('offer')
                            ->latest()
                            ->limit(100)
                            ->get();

        return view('home.asin')->with(compact('item', 'histories'));
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
            'asin'  => $asin,
            'title' => $title,
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Item $item
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Model\Item          $item
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Item $item
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }
}
