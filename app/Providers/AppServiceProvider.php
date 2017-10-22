<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Blade;

use Laravel\Dusk\DuskServiceProvider;

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

        Blade::if('admin', function () {
            return request()->user()->isAdmin();
        });

        Blade::if('feature', function ($feature) {
            return config('amazon-feature.' . $feature);
        });
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
