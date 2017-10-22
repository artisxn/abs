<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repository\Item\ItemRepositoryInterface;
use App\Repository\Item\EloquentItemRepository;

use App\Repository\Browse\BrowseRepositoryInterface;
use App\Repository\Browse\EloquentBrowseRepository;

use App\Repository\WorldItem\WorldItemRepositoryInterface;
use App\Repository\WorldItem\EloquentWorldItemRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        app()->singleton(
            ItemRepositoryInterface::class,
            EloquentItemRepository::class
        );

        app()->singleton(
            BrowseRepositoryInterface::class,
            EloquentBrowseRepository::class
        );

        app()->singleton(
            WorldItemRepositoryInterface::class,
            EloquentWorldItemRepository::class
        );
    }
}
