<?php

namespace App\Http\Controllers\Download;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Jobs\Download\ExportCategoryJob;

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
        ExportCategoryJob::dispatch(
            $request->user(),
            $category,
            'updated_at',
            'desc',
            $request->user()->csvLimit()
        );

        return view('export.queue');
    }
}
