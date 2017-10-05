<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use AmazonProduct;
use App\Model\Item;

/**
 * Class ItemJob
 *
 * ASINからアイテム情報を取得
 *
 * @package App\Jobs
 */
class ItemJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    protected $asin;

    /**
     * Create a new job instance.
     *
     * @param string|null $asin
     */
    public function __construct(string $asin = null)
    {
        $this->asin = $asin;
    }

    /**
     * Execute the job.
     *
     * @return array
     */
    public function handle(): array
    {
        if (empty($this->asin)) {
            return [];
        }

        $item = cache()->remember('asin.' . $this->asin, 60 * 6, function () {
            //            sleep(1);

            return rescue(function () {
                return $this->get();
            });
        });

        if (empty($item)) {
            cache()->delete('asin.' . $this->asin);

            $item = [];
        }

        return $item;
    }

    /**
     * @return array
     */
    public function get()
    {
        $results = retry(5, function () {
            return AmazonProduct::item($this->asin);
        }, 5000);

        $item = array_get($results, 'Items.Item', []);

        $this->createItem($item);

        //        $this->similar($item);

        return $item;
    }

    /**
     * @param array|null $item
     */
    public function createItem(array $item = null)
    {
        $asin = array_get($item, 'ASIN');

        if (empty($asin)) {
            return;
        }

        $rank = array_get($item, 'SalesRank');
        $title = array_get($item, 'ItemAttributes.Title');
        $attributes = array_get($item, 'ItemAttributes');
        $offer_summary = array_get($item, 'OfferSummary');
        $offers = array_get($item, 'Offers');
        $image_sets = array_get($item, 'ImageSets');
        $large_image = array_get($item, 'LargeImage.URL');
        $detail_url = array_get($item, 'DetailPageURL');

        info($title);

        $new_item = Item::updateOrCreate([
            'asin' => $asin,
        ], compact([
            'title',
            'rank',
            'attributes',
            'offer_summary',
            'offers',
            'image_sets',
            'large_image',
            'detail_url',
        ]));

        $browse_nodes = $this->browseNodes($item);

        $new_item->browses()->sync($browse_nodes);

        //必ずItemの後にHistory
        $this->createHistory($item);
    }

    /**
     * @param array $item
     *
     * @return array
     */
    private function browseNodes(array $item): array
    {
        $ids = [];
        $nodes = array_get($item, 'BrowseNodes');

        while ($nodes = array_get($nodes, 'BrowseNode')) {
            if (!array_has($nodes, 'BrowseNodeId')) {
                $nodes = head($nodes);
            }

            $ids[] = (int)array_get($nodes, 'BrowseNodeId');

            $nodes = array_get($nodes, 'Ancestors');
        }

        return $ids;
    }

    /**
     * @param array|null $item
     */
    private function createHistory(array $item = null)
    {
        dispatch_now(new CreateHistoryJob($item));
    }

    /**
     * 関連商品の情報も取得。永遠に終わらないので使用するかはよく考える。
     *
     * @param array|null $item
     */
    public function similar(array $item = null)
    {
        if (empty($item)) {
            return;
        }

        $asins = data_get($item, 'SimilarProducts.SimilarProduct.*.ASIN');

        if (!empty($asins)) {
            PreloadJob::dispatch($asins);
        }
    }
}
