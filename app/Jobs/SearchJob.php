<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use AmazonProduct;

class SearchJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    protected $category;

    /**
     * @var string
     */
    protected $keyword;

    /**
     * @var int
     */
    protected $page;

    /**
     * Create a new job instance.
     *
     * @param string $category
     * @param string $keyword
     * @param int    $page
     */
    public function __construct(string $category, string $keyword, int $page = 1)
    {
        $this->category = $category;
        $this->keyword = $keyword;
        $this->page = $page;
    }

    /**
     * Execute the job.
     *
     * @return array
     */
    public function handle()
    {
        //        info('Search: ' . $this->keyword);

        $page = $this->page;

        if ($page > 10) {
            $page = 10;
        }

        \Redis::throttle('amazon-api-search')->allow(1)->every(5)->then(function () use (&$results) {
            $results = rescue(function () {
                return AmazonProduct::search($this->category, $this->keyword, $this->page);
            });
        }, function () {
            info('Amazon API Throttle: Search ' . $this->keyword);

            return [];
        });

        $item = array_get($results, 'Items');

        $TotalResults = array_get($item, 'TotalResults');

        //1件の場合は
        if ($TotalResults === '1') {
            $items = [array_get($item, 'Item')];
        } else {
            $items = array_get($item, 'Item');
        }

        $items = collect($items);

        $TotalPages = array_get($item, 'TotalPages');

        $MoreSearchResultsUrl = array_get($item, 'MoreSearchResultsUrl');
        if (!empty($MoreSearchResultsUrl)) {
            session(['MoreSearchResultsUrl' => $MoreSearchResultsUrl]);
        }

        return compact(
            'items',
            'page',
            'TotalResults',
            'TotalPages'
        );
    }
}
