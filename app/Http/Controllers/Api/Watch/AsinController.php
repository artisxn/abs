<?php

namespace App\Http\Controllers\Api\Watch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Watch;

class AsinController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'asin'     => 'required|size:10',
            'priority' => 'nullable|in:0,1',
        ]);

        $watch = Watch::updateOrCreate([
            'asin_id' => $request->input('asin'),
            'user_id' => $request->user()->id,
        ], [
            'asin_id'  => $request->input('asin'),
            'user_id'  => $request->user()->id,
            'priority' => $request->input('priority', 0),
        ]);

        return response()->json($watch);
    }
}
