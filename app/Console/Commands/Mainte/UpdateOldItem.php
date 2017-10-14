<?php

namespace App\Console\Commands\Mainte;

use Illuminate\Console\Command;

use App\Jobs\PreloadJob;

use App\Repository\Item\ItemRepositoryInterface as Item;

class UpdateOldItem extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'abs:old-item';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '更新時間の古いアイテムのデータを減らす';

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
        $items = $repository->oldCursor(1000);

        foreach ($items as $item) {
            $item->update([
                'attributes'    => null,
                'offer_summary' => null,
                'offers'        => null,
                'image_sets'    => null,
                'large_image'   => null,
                'detail_url'    => null,
            ]);
        }

        info('Update Old Item');
    }
}
