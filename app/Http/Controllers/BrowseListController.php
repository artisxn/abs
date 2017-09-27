<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Browse;

class BrowseListController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function browseList()
    {
        $lists = config('amazon-browse');

        return view('browse.list')->with(compact('lists'));
    }

    /**
     * @param Browse $browse
     *
     * @return \Illuminate\Http\Response
     */
    public function browseAll(Browse $browse)
    {
        $lists = $browse->withCount('items')->get();

        return view('browse.list-all')->with(compact('lists'));
    }
}
