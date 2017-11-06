<?php

namespace App\Http\Controllers\BrowseList;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrowseListController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $lists = config('amazon-browse');

        return view('browse.list')->with(compact('lists'));
    }
}
