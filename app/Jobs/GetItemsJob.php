<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use AmazonProduct;
use App\Repository\Item\ItemRepositoryInterface as Item;

/**
 * 複数のASINを取得
 *
 * Class GetItemsJob
 * @package App\Jobs
 */
class GetItemsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array
     */
    protected $asins;

    /**
     * @var Item
     */
    protected $repository;

    /**
     * Create a new job instance.
     *
     * @param array $asins
     *
     */
    public function __construct(array $asins)
    {
        $this->asins = $asins;
    }

    /**
     * Execute the job.
     *
     * @param Item $repository
     *
     * @return array
     */
    public function handle(Item $repository): array
    {
        $this->repository = $repository;

        info(self::class);

        if (empty($this->asins)) {
            return [];
        }

        if (count($this->asins) > 10) {
            return [];
        }

        $items = rescue(function () {
            return $this->get();
        });

        if (empty($items) or array_has(array_first($items), 'ASIN') === false) {
            return [];
        }

        foreach ($items as $item) {
            $asin = array_get($item, 'ASIN');
            if (!empty($asin)) {
                $this->repository->create($item);

                //必ずItemの後にHistory
                $this->createHistory($item);

                cache()->put(
                    'asin.' . $asin,
                    $item,
                    60 * 6
                );
            }
        }

        return $items;
    }

    /**
     * @return array
     */
    public function get()
    {
        $results = retry(5, function () {
            return AmazonProduct::items($this->asins);
        }, 3000);

        //        $results = rescue(function () {
        //            return AmazonProduct::items($this->asins);
        //        });

        if (empty($results)) {
            $items = [];
        } else {
            $items = array_get($results, 'Items.Item');
        }

        return $items;
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
}
