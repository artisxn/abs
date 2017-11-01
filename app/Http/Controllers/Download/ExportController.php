<?php

namespace App\Http\Controllers\Download;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Jobs\Download\ExportCategoryJob;
use App\Http\Requests\ExportRequest;

class ExportController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('export');

        return view('export.index');
    }

    /**
     * @param ExportRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function export(ExportRequest $request)
    {
        $this->authorize('export');

        $category = $request->input('category_id');
        $order = $request->input('order', 'updated_at');
        $sort = $request->input('sort', 'desc');
        $limit = $request->input('limit');

        ExportCategoryJob::dispatch(
            $request->user(),
            $category,
            $order,
            $sort,
            $limit
        );

        return view('export.queue');
    }
}
