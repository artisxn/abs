<?php

namespace App\Http\Controllers\Download;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\Csv\Item as ItemResource;

use League\Csv\Writer;

use App\Model\Item;

class CategoryController extends Controller
{
    /**
     * @param Request $request
     * @param         $category
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $category)
    {
        $file = storage_path($request->user()->id . '-cat-download.csv');

        $writer = Writer::createFromPath($file, 'w+');

        $writer->insertOne(config('amazon.csv_header'));

        //         特定カテゴリーのアイテムリスト
        $items = Item::where('browse', 'LIKE', '%"BrowseNodeId": "' . $category . '"%')
                     ->latest('updated_at')
                     ->take(config('amazon.csv_limit'))
                     ->cursor();

        foreach ($items as $item) {
            $line = (new ItemResource($item))->toArray($request);

            $writer->insertOne($line);
        }


        $file_name = 'abs-category-' . $category . '-' . today()->toDateString() . '.csv';

        return response()->download($file, $file_name)
                         ->deleteFileAfterSend(true);
    }
}
