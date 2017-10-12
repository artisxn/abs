<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class BrowseWatchViewComposer
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
        $browse_watches = request()->user()
                                   ->browseWatches()
                                   ->with(['browse'])
                                   ->withCount('browseItems')
                                   ->latest()
                                   ->paginate(50)
                                   ->withPath('/watch/browse');

        $view->with(compact('browse_watches'));
    }
}
