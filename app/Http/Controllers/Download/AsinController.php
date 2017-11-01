<?php

namespace App\Http\Controllers\Download;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Jobs\Download\ExportAsinJob;

class AsinController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        ExportAsinJob::dispatch($request->user());

        return view('export.queue');
    }
}
