<?php

namespace App\Http\Controllers;

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
        $watches = auth()->user()
                         ->watches()
                         ->with('item')
                         ->latest()
                         ->paginate(50);

        return view('watch.index')->with(compact('watches'));
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
        $watch = Watch::updateOrCreate([
            'asin_id' => $request->input('asin'),
            'user_id' => $request->user()->id,
        ], [
            'asin_id' => $request->input('asin'),
            'user_id' => $request->user()->id,
        ]);

        return back();
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
        if ($watch->user_id === auth()->user()->id) {
            $watch->delete();

            return redirect()->route('asin', $watch->asin_id);
        } else {
            return back();
        }
    }
}
