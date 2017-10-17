<?php

namespace App\Http\Controllers\Download;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Storage;

class CsvController extends Controller
{
    /**
     * @param Request $request
     * @param         $file_name
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $file_name)
    {
        $name = 'csv/' . $request->user()->id . '/' . $file_name;

        abort_unless(Storage::exists($name), 404);

        $file = storage_path('app/' . $name);

        return response()->download($file, $file_name)
                         ->deleteFileAfterSend(true);
    }
}
