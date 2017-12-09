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

        foreach ($items as $item) {
            dispatch_now(new PriceCheckJob($item));
        }

        cache()->delete('price_alert_posts');

        info(self::class . ': End');
    }
}
