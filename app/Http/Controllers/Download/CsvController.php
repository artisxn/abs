<?php

namespace App\Http\Controllers\Download;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Storage;

use App\Jobs\Download\DeleteCsvJob;

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

        DeleteCsvJob::dispatch($name)->delay(now()->addMinutes(3));

        return Storage::download($name);
    }
}
