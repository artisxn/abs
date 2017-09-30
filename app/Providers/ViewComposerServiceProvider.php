<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;

use App\Http\ViewComposers\RandomBrowseViewComposer;
use App\Http\ViewComposers\ItemCountViewComposer;
use App\Http\ViewComposers\HistoryCountViewComposer;
use App\Http\ViewComposers\BrowseCountViewComposer;
use App\Http\ViewComposers\RecentItemViewComposer;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('home.index', RandomBrowseViewComposer::class);

        View::composer('home.index', RecentItemViewComposer::class);

        View::composer('pages.usage', BrowseCountViewComposer::class);

        View::composer('pages.usage', ItemCountViewComposer::class);

        View::composer('pages.usage', HistoryCountViewComposer::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
