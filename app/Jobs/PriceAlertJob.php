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
     */
    public function handle(Item $repository)
    {
        $items = $repository->priceAlert();

        //        dd($items);

        foreach ($items as $item) {
            if ($item->histories->count() < 2) {
                continue;
            }

            $histories = $item->histories()->latest('day')->limit(2);

            $price = $histories->pluck('lowest_new_price');

            $price_today = $price->first();
            $price_yesterday = $price->last();

            if ($price_yesterday == 0) {
                continue;
            }

            $price_move = $price_today / $price_yesterday;

            //            info('Price Alert: ' . $price_move);

            //20%以上アップ
            if ($price_move >= 1.2) {
                info('Price UP: ' . $item->title . ' ' . $price_yesterday . ' => ' . $price_today);
                //Postに追加
            }

            //20%以上ダウン
            if ($price_move <= 0.8) {
                info('Price DOWN: ' . $item->title . ' ' . $price_yesterday . ' => ' . $price_today);

            }
        }
    }
}
