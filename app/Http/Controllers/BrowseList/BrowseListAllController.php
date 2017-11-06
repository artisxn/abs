<?php

namespace App\Http\Controllers\BrowseList;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repository\Browse\BrowseRepositoryInterface as Browse;

class BrowseListAllController extends Controller
{
    /**
     * @param Browse  $repository
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Browse $repository)
    {
        $lists = $repository->listAll();

        return view('browse.list-all')->with(compact('lists'));
    }
}
