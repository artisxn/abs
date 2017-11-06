<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AmazonController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return view('home.index');
    }
}
