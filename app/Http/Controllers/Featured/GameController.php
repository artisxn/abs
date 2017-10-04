<?php

namespace App\Http\Controllers\Featured;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Browse;

class GameController extends Controller
{
    public function __invoke()
    {
        $items = Browse::find(637394)->items()->latest()->with('browses')->paginate(50);

        return view('featured.game')->with(compact('items'));
    }
}
