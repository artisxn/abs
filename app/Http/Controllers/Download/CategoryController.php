<?php

namespace App\Http\Controllers\Download;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Jobs\ExportCategoryJob;

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

        $file = dispatch_now(new ExportCategoryJob($file, $category, 'updated_at', 'desc', config('amazon.csv_limit')));

        $file_name = 'abs-category-' . $category . '-' . today()->toDateString() . '.csv';

        return response()->download($file, $file_name)
                         ->deleteFileAfterSend(true);
    }
}
