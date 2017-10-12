<?php

namespace App\Http\Controllers\Watch;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class WatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('watch.index');
    }
}
