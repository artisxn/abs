<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use AmazonProduct;

use App\Model\Browse;

class BrowseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    protected $browse;

    /**
     * @var string
     */
    protected $response;

    /**
     * Create a new job instance.
     *
     * @param string $browse
     * @param string $response
     */
    public function __construct(string $browse, string $response = 'TopSellers')
    {
        $this->browse = $browse;
        $this->response = $response;
    }

    /**
     * Execute the job.
     *
     * @return array
     */
    public function handle()
    {
        $cache_key = 'browse.' . $this->response . '.' . $this->browse;

        $result = cache()->remember($cache_key, 60, function () {
            //            sleep(1);

            return rescue(function () {
                return AmazonProduct::browse($this->browse, $this->response);
            });
        });

        if (empty($result)) {
            cache()->delete($cache_key);

            return [
                'browse_name'  => '',
                'browse_items' => [],
                'browse_id'    => $this->browse,
            ];
        }

        $nodes = array_get($result, 'BrowseNodes');

        $browse_name = array_get($nodes, 'BrowseNode.Name');


        $items = array_get($nodes, 'BrowseNode.' . $this->response . '.' . str_singular($this->response));

        if (empty($items)) {
            cache()->delete($cache_key);

            return [
                'browse_name'  => $browse_name,
                'browse_items' => [],
                'browse_id'    => $this->browse,
            ];
        }


        $br = Browse::updateOrCreate([
            'id' => $this->browse,
        ], [
            'id'    => $this->browse,
            'title' => $browse_name,
        ]);

        $asins = array_pluck($items, 'ASIN');

        $cache_key_asin = 'items.' . implode('.', $asins);
        $results = cache()->remember($cache_key_asin, 60, function () use ($asins) {
            sleep(1);

            return rescue(function () use ($asins) {
                return AmazonProduct::items($asins);
            });
        });

        if (empty($results)) {
            cache()->delete($cache_key_asin);
        }

        PreloadJob::dispatch($asins);

        $browse_items = array_get($results, 'Items.Item');

        return [
            'browse_name'  => $browse_name,
            'browse_items' => $browse_items,
            'browse_id'    => $this->browse,
        ];
    }
}
