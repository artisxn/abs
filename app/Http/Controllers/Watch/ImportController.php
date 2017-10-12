<?php

namespace App\Http\Controllers\Watch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Watch\ImportRequest;

use App\Jobs\Watch\JanImportJob;

class ImportController extends Controller
{
    /**
     * @param ImportRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ImportRequest $request)
    {
        if (!$request->hasFile('jan_csv') or !$request->file('jan_csv')->isValid()) {
            return back();
        }

        $path = $request->file('jan_csv')->path();

        $jan_count = dispatch_now(new JanImportJob($path, $request->user()->id));

        return view('watch.import')->with(compact('jan_count'));
    }
}
