<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Browse;

class BrowseListController extends Controller
{
    /**
     * @param Browse $browse
     *
     * @return \Illuminate\Http\Response
     */
    public function browseList(Browse $browse)
    {
        $lists = $browse->all();

        return view('browse.list-all')->with(compact('lists'));
    }
}
