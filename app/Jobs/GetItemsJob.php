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

use App\Notifications\NewItemNotification;

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
    protected $itemRepository;

    /**
     * @var Browse
     */
    protected $browseRepository;

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
     * @param Item   $itemRepository
     * @param Browse $browseRepository
     *
     * @return array
     *
     * @throws \Exception
     */
    public function handle(Item $itemRepository, Browse $browseRepository): array
    {
        //        info(self::class);

        $this->itemRepository = $itemRepository;
        $this->browseRepository = $browseRepository;

        if (empty($this->asins)) {
            return [];
        }

        if (count($this->asins) > 10) {
            return [];
        }

        $items = $this->get();

        if (empty($items)) {
            return [];
        }

        foreach ($items as $item) {
            $asin = array_get($item, 'ASIN');

            if (empty($asin)) {
                continue;
            }

            $new_item = $this->itemRepository->create($item);

            //新着を通知
            if ($new_item->wasRecentlyCreated) {
                $new_item->notify(new NewItemNotification);
            }

            $browse_nodes = abs_browse_nodes($item);
            $this->browseRepository->createNodes($browse_nodes);

            $new_item->browses()->sync(array_values($browse_nodes));

            //必ずItemの後にHistory
            $this->createHistory($item);

            cache()->put('asin.' . $asin, $item, 60 * 6);
        }

        return $items;
    }

    /**
     * @return array
     */
    public function get()
    {
        $results = rescue(function () {
            return AmazonProduct::setIdType('ASIN')->items($this->asins);
        });

        $items = array_get($results, 'Items.Item');

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
