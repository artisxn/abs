<?php

namespace App\Http\Controllers\Watch;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Model\BrowseWatch;

class BrowseWatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $watch = BrowseWatch::updateOrCreate([
            'browse_id' => $request->input('browse'),
            'user_id'   => $request->user()->id,
        ], [
            'browse_id' => $request->input('browse'),
            'user_id'   => $request->user()->id,
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  BrowseWatch $browse
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(BrowseWatch $browse)
    {
        if ($browse->user_id === auth()->user()->id) {
            $browse->delete();

            return redirect()->route('browse', $browse->browse_id);
        } else {
            return back();
        }
    }
}
