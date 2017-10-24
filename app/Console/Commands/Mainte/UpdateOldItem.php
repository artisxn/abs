<?php

namespace App\Console\Commands\Mainte;

use Illuminate\Console\Command;

use App\Jobs\GetItemsJob;

use App\Repository\Item\ItemRepositoryInterface as Item;

class UpdateOldItem extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'abs:update-old-item';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '更新時間の古いアイテムを更新';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param Item $repository
     *
     * @return mixed
     */
    public function handle(Item $repository)
    {
        $asins = collect([]);

        $items = $repository->oldCursor(100);


        foreach ($items as $item) {
            $asins->push($item->asin);
        }

        info('Update Old Item: ' . count($asins));

        $delay = 0;

        foreach ($asins->chunk(10) as $items) {
            info('Update Old Item: ' . $items->first());

            GetItemsJob::dispatch($items->toArray())->delay(now()->addMinutes($delay * 3));

            $delay++;
        }
    }
}
