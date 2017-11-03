<?php

namespace App\Http\Controllers\Api\Watch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\BrowseWatch;

class BrowseController extends Controller
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
            'browse' => 'required|integer',
        ]);

        $watch = BrowseWatch::updateOrCreate([
            'browse_id' => $request->input('browse'),
            'user_id'   => $request->user()->id,
        ], [
            'browse_id' => $request->input('browse'),
            'user_id'   => $request->user()->id,
        ]);

        return response()->json($watch);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request $request
     * @param  int     $browse
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $browse)
    {
        $watch = $request->user()->browseWatches()->whereBrowseId($browse)->first();

        abort_if(empty($watch), 404);

        $watch->delete();

        return response()->json();
    }
}
