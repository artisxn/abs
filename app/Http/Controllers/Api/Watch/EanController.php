<?php

namespace App\Http\Controllers\Api\Watch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Jobs\Watch\JanToAsinJob;

class EanController extends Controller
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
            'ean' => 'required|size:13',
        ]);

        JanToAsinJob::dispatch([$request->input('ean')], $request->user()->id);

        return response()->json([
            'message' => 'JAN/EANインポートを開始しました。',
        ]);
    }
}
