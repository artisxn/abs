<?php

namespace App\Http\Controllers\Watch;

use App\Http\Controllers\Controller;

use App\Model\Watch;
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
        $asin_watches = auth()->user()
                              ->watches()
                              ->with('item')
                              ->latest()
                              ->get();

        $browse_watches = auth()->user()
                                ->browseWatches()
                                ->with('browse')
                                ->latest()
                                ->get();

        return view('watch.index')->with(compact('asin_watches', 'browse_watches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Watch $watch
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Watch $watch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Watch $watch
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Watch $watch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Model\Watch         $watch
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Watch $watch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Watch $watch
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Watch $watch)
    {
        //
    }
}
