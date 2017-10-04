<?php

namespace App\Http\Controllers\Featured;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Browse;

class GameController extends Controller
{
    public function __invoke()
    {
        $items = Browse::find(637394)->items()->with('browses')->paginate(500);

        return view('featured.game')->with(compact('items'));
    }
}
