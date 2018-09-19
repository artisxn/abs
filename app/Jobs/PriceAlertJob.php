<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Repository\Item\ItemRepositoryInterface as Item;

class PriceAlertJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * 最大試行回数
     *
     * @var int
     */
    public $tries = 2;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @param Item $repository
     *
     * @return void
     *
     * @throws \Exception|\Psr\SimpleCache\InvalidArgumentException
     */
    public function handle(Item $repository)
    {
        info(self::class);

        $items = $repository->priceAlert();

        cache()->delete('price_alert_posts');

        foreach ($items as $item) {
            PriceCheckJob::dispatch($item);
        }

        //        info(self::class . ': End');
    }
}
