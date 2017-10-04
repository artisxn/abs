<?php

namespace App\Http\Controllers\Featured;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Item;

class GameController extends Controller
{
    public function __invoke()
    {
        $items = cache()->remember('featured.game', 60, function () {
            return Item::latest()->with('browses')->whereHas('browses', function ($query) {
                $query->whereBrowseId(637394);
            })->get();
        });

        return view('featured.game')->with(compact('items'));
    }
}
