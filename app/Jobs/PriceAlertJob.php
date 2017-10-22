<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Repository\Item\ItemRepositoryInterface as Item;

use App\Model\Post;

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
        info(self::class);

        $items = $repository->priceAlert();

        //        dd($items);

        foreach ($items as $item) {
            if ($item->histories->count() < 2) {
                continue;
            }

            $histories = $item->histories()->latest('day')->limit(2);

            $price = $histories->pluck('lowest_new_price');

            $price_today = (int)$price->first();
            $price_yesterday = (int)$price->last();

            if ($price_today == 0 or $price_yesterday == 0) {
                continue;
            }

            $price_move = $price_today / $price_yesterday;

            //            info('Price Alert: ' . $price_move);

            //20%以上アップ
            if ($price_move >= 1.2) {
                //                info('Price UP: ' . $item->title . ' ' . $price_yesterday . ' => ' . $price_today);

                $slug = 'up_' . $item->asin;

                //Postに追加
                $post = Post::updateOrCreate([
                    'slug' => $slug,
                ], [
                    'author_id'   => 1,
                    'category_id' => 2,
                    'title'       => $item->title,
                    'body'        => $price_yesterday . '円 => ' . $price_today . '円',
                    'excerpt'     => $item->asin,
                    'slug'        => $slug,
                    //                    'image'       => $item->large_image,
                    'status'      => Post::PUBLISHED,
                ]);

                //                break;
            }

            //20%以上ダウン
            if ($price_move <= 0.8) {
                //                info('Price DOWN: ' . $item->title . ' ' . $price_yesterday . ' => ' . $price_today);

                $slug = 'down_' . $item->asin;

                $post = Post::updateOrCreate([
                    'slug' => $slug,
                ], [
                    'author_id'   => 1,
                    'category_id' => 3,
                    'title'       => $item->title,
                    'body'        => $price_yesterday . '円 => ' . $price_today . '円',
                    'excerpt'     => $item->asin,
                    'slug'        => $slug,
                    //                    'image'       => $item->large_image,
                    'status'      => Post::PUBLISHED,
                ]);

                //                break;
            }
        }

        info(self::class . ': End');
    }
}
