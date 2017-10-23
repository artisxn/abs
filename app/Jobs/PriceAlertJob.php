<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Repository\Item\ItemRepositoryInterface as Item;

use App\Model\Post;

use Notification;
use App\Notifications\PriceAlertNotification;

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

        foreach ($items as $item) {
            if ($item->histories->count() < 2) {
                continue;
            }

            $slug = null;
            $category_id = null;

            $histories = $item->histories()->latest('day')->limit(2);

            $price = $histories->pluck('lowest_new_price');

            $price_today = (int)$price->first();
            $price_yesterday = (int)$price->last();

            if ($price_today == 0 or $price_yesterday == 0) {
                continue;
            }

            $price_move = $price_today / $price_yesterday;

            //20%以上アップ
            if ($price_move >= 1.2) {
                $slug = 'up_' . $item->asin;
                $category_id = 2;
            }

            //20%以上ダウン
            if ($price_move <= 0.8) {
                $slug = 'down_' . $item->asin;
                $category_id = 3;
            }

            if (filled($slug)) {
                //Postに追加
                $post = Post::updateOrCreate([
                    'slug' => $slug,
                ], [
                    'author_id'   => 1,
                    'category_id' => $category_id,
                    'title'       => $item->title,
                    'body'        => $price_yesterday . '円 => ' . $price_today . '円',
                    'excerpt'     => $item->asin,
                    'slug'        => $slug,
                    //                    'image'       => $item->large_image,
                    'status'      => Post::PUBLISHED,
                ]);

                //ウォッチリストにあるアイテムなら通知
                if ($item->users()->count() > 0) {
                    Notification::send($item->users()->get(), new PriceAlertNotification($post));
                }
            }
        }

        cache()->delete('price_alert_posts');

        info(self::class . ': End');
    }
}
