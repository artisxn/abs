<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use AmazonProduct;
use App\Repository\Item\ItemRepositoryInterface as Item;
use App\Repository\Browse\BrowseRepositoryInterface as Browse;

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
     * @var Item
     */
    protected $itemRepository;

    /**
     * @var Browse
     */
    protected $browseRepository;

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
     * @param Item   $itemRepository
     * @param Browse $browseRepository
     *
     * @return array
     */
    public function handle(Item $itemRepository, Browse $browseRepository): array
    {
        $this->itemRepository = $itemRepository;
        $this->browseRepository = $browseRepository;

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
            return AmazonProduct::setIdType('ASIN')->item($this->asin);
        }, 5000);

        $item = array_get($results, 'Items.Item');

        $new_item = $this->itemRepository->create($item);

        if (empty($new_item)) {
            return null;
        }

        $browse_nodes = browse_nodes($item);
        $this->browseRepository->createNodes($browse_nodes);

        $new_item->browses()->sync(array_values($browse_nodes));

        //必ずItemの後にHistory
        $this->createHistory($item);

        //        $this->similar($item);

        return $item;
    }

    /**
     * @param array|null $item
     */
    private function createHistory(array $item = null)
    {
        if (empty($item)) {
            return;
        }

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
