<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Jobs\ExportCategoryJob;
use App\Http\Requests\ExportRequest;

class ExportController extends Controller
{
    public function index()
    {
        $this->authorize('export');

        return view('export.index');
    }

    public function export(ExportRequest $request)
    {
        $this->authorize('export');

        $file = storage_path('cat-export.csv');

        $category = $request->input('category');
        $order = $request->input('order', 'updated_at');
        $sort = $request->input('sort', 'desc');
        $limit = $request->input('limit');

        $file = dispatch_now(new ExportCategoryJob($file, $category, $order, $sort, $limit));

        $file_name = 'abs-category-' . $category . '-' . today()->toDateString() . '.csv';

        return response()->download($file, $file_name)
                         ->deleteFileAfterSend(true);
    }
}
