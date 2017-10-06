<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repository\Browse\BrowseRepositoryInterface as Browse;

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
     * @param Browse  $repository
     *
     * @return \Illuminate\Http\Response
     */
    public function browseAll(Request $request, Browse $repository)
    {
        $lists = $repository->listAll();

        return view('browse.list-all')->with(compact('lists'));
    }
}
