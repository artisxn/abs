<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use AmazonProduct;

use App\Repository\Browse\BrowseRepositoryInterface as Browse;

class BrowseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    protected $browse_id;

    /**
     * @var string
     */
    protected $response;

    /**
     * Create a new job instance.
     *
     * @param string $browse_id
     * @param string $response
     */
    public function __construct(string $browse_id, string $response = 'TopSellers')
    {
        $this->browse_id = $browse_id;
        $this->response = $response;
    }

    /**
     * Execute the job.
     *
     * @param Browse $repository
     *
     * @return array
     */
    public function handle(Browse $repository)
    {
        /**
         * 1. BrowseNodeLookup は詳細なデータを返さないので一度ブラウズノードを取得してから
         */
        $browse = $this->browse();

        if (empty($browse)) {
            return [
                'browse_name'  => '',
                'browse_items' => [],
                'browse_id'    => $this->browse_id,
            ];
        }

        $nodes = array_get($browse, 'BrowseNodes');

        $browse_name = array_get($nodes, 'BrowseNode.Name');

        //        info(self::class . ': ' . $browse_name);

        if (!empty($browse_name)) {
            $repository->updateOrCreate([
                'id' => $this->browse_id,
            ], [
                'title' => $browse_name,
            ]);
        }

        /**
         * 2. 各ASINで再度詳細データを取得する
         */
        $items = array_get($nodes, 'BrowseNode.' . $this->response . '.' . str_singular($this->response));

        if (empty($items)) {
            return [
                'browse_name'  => $browse_name,
                'browse_items' => [],
                'browse_id'    => $this->browse_id,
            ];
        }

        $asins = array_pluck($items, 'ASIN');

        $browse_items = $this->items($asins);

        return [
            'browse_name'  => $browse_name,
            'browse_items' => $browse_items,
            'browse_id'    => $this->browse_id,
        ];
    }

    /**
     * @return array
     */
    protected function browse()
    {
        $cache_key = 'browse.' . $this->response . '.' . $this->browse_id;

        $browse = cache()->remember($cache_key, 60, function () {
            return rescue(function () {
                return AmazonProduct::browse($this->browse_id, $this->response);
            });
        });

        if (empty($browse)) {
            cache()->delete($cache_key);
        }

        return $browse;
    }

    /**
     * @param array|null $asins
     *
     * @return array
     */
    protected function items(array $asins = null)
    {
        if (empty($asins)) {
            return [];
        }

        $asins = array_sort($asins);

        $cache_key_asin = 'items.' . implode('.', $asins);

        $items = cache()->remember($cache_key_asin, 60, function () use ($asins) {
            sleep(1);

            return dispatch_now(new GetItemsJob($asins));
        });

        if (empty($items)) {
            cache()->delete($cache_key_asin);
        }

        return $items;
    }
}
