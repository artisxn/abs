<?php

namespace App\Http\Controllers;

use App\Jobs\BrowseJob;
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
     * @param Request $request
     * @param Browse  $browse
     *
     * @return \Illuminate\Http\Response
     */
    public function browseAll(Request $request, Browse $browse)
    {
        $lists = $browse->listAll();

        return view('browse.list-all')->with(compact('lists'));
    }
}
