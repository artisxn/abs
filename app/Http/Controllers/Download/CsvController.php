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
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function __invoke(Request $request, $file_name)
    {
        $name = 'csv/' . $request->user()->id . '/' . $file_name;

        abort_unless(Storage::exists($name), 404);

        //        $file = Storage('app/' . $name);

        return Storage::download($name);

        //        return response()->download($file, $file_name)
        //                         ->deleteFileAfterSend(true);
    }
}
