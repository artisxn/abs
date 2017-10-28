<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

use JsonLd\Context;

class SearchFormViewComposer
{
    /**
     * データをビューと結合
     *
     * @param  View $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        $search_json_ld = Context::create('search_box', [
            'url'             => config('app.url'),
            'potentialAction' => [
                'target'      => route('search') . '?keyword={search_keyword}',
                'query-input' => 'required name=search_keyword',
            ],
        ]);

        $view->with(compact('search_json_ld'));
    }
}
