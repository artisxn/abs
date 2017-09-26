<?php

namespace App\Http\Controllers\Download;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\Csv\Item as ItemResource;

use League\Csv\Writer;

class AsinController extends Controller
{
    public function __invoke(Request $request)
    {
        $file = storage_path($request->user()->id . '-asin-download.csv');

        $writer = Writer::createFromPath($file, 'w+');

        $writer->insertOne(config('amazon.csv_header'));

        $items = $request->user()
                         ->watches()
                         ->with('item')
                         ->latest()
                         ->take(config('amazon.csv_limit'))
                         ->cursor();


        foreach ($items as $item) {
            $line = (new ItemResource($item->item))->toArray($request);

            $writer->insertOne($line);
        }


        $file_name = 'abs-asin-' . today()->toDateString() . '.csv';

        return response()->download($file, $file_name)
                         ->deleteFileAfterSend(true);
    }
}
