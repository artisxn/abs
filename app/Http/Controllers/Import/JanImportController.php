<?php

namespace App\Http\Controllers\Import;

use App\Http\Controllers\Controller;

use App\Http\Requests\Import\ImportRequest;

use App\Jobs\Import\JanImportJob;

class JanImportController extends Controller
{
    /**
     * @param ImportRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ImportRequest $request)
    {
        if (!$request->hasFile('csv') or !$request->file('csv')->isValid()) {
            return back();
        }

        $path = $request->file('csv')->path();

        $csv_count = dispatch_now(new JanImportJob($path, $request->user()->id));

        return view('import.start')->with(compact('csv_count'));
    }
}
