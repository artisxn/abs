<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;

use Horizon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->share('keyword', request()->input('keyword'));
        view()->share('category', request()->input('category', 'All'));

        Horizon::auth(function ($request) {
            return $request->user()->isAdmin();
        });

        Blade::if('admin', function () {
            return request()->user()->isAdmin();
        });

        Blade::if('feature', function ($feature) {
            return config('feature.' . $feature);
        });

        Blade::if('adsense', function ($item) {
            return !data_get($item->item_attribute->attributes, 'IsAdultProduct')
                and !in_array(data_get($item, 'ASIN'), config('adsense.ignore'));
        });

        Paginator::defaultView('vendor.pagination.default');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
