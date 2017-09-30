<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

use App\Service\BrowseService;

class RandomBrowseViewComposer
{
    /**
     * @var BrowseService
     */
    protected $service;

    /**
     * @param  BrowseService $service
     *
     */
    public function __construct(BrowseService $service)
    {
        $this->service = $service;
    }

    /**
     * データをビューと結合
     *
     * @param  View $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        $browse_items = cache()->remember('random_items', 60, function () {
            $browse = collect(config('amazon-browse'))->random();

            return $this->service->browse($browse);
        });

        $view->with($browse_items);
    }
}
