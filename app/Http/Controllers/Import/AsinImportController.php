<?php

namespace App\Http\Controllers\Import;

use App\Http\Controllers\Controller;

use Storage;

use App\Http\Requests\Import\ImportRequest;

use App\Jobs\Import\AsinImportJob;

class AsinImportController extends Controller
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

        $file = $request->file('csv')
                        ->storeAs('csv/' . $request->user()->id, 'import.csv');

        $path = Storage::path($file);

        //ASINの場合ウォッチリストへの追加はすぐに完了
        AsinImportJob::dispatch($path, $request->user()->id);

        return view('import.start');
    }
}
