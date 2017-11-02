<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Model\Item;
use App\Model\Post;

use Notification;

use App\Notifications\WatchPriceAlertNotification;
use App\Notifications\PriceAlertNotification;

class PriceCheckJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Item
     */
    protected $item;

    /**
     * Create a new job instance.
     *
     * @param Item $item
     *
     * @return void
     */
    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (empty($this->item)) {
            return;
        }

        if ($this->item->histories->count() < 2) {
            return;
        }

        $slug = null;
        $category_id = null;

        $histories = $this->item->histories()->latest('day')->limit(2);

        $price = $histories->pluck('lowest_new_price');

        $price_today = (int)$price->first();
        $price_yesterday = (int)$price->last();

        if ($price_today == 0 or $price_yesterday == 0) {
            return;
        }

        $price_move = $price_today / $price_yesterday;

        //20%以上アップ
        if ($price_move >= 1.2) {
            $slug = 'up_' . $this->item->asin;
            $category_id = config('amazon.price_alert.up');
        }

        //20%以上ダウン
        if ($price_move <= 0.8) {
            $slug = 'down_' . $this->item->asin;
            $category_id = config('amazon.price_alert.down');
        }

        if (filled($slug)) {
            //Postに追加
            /**
             * @var Post $post
             */
            $post = Post::updateOrCreate([
                'slug' => $slug,
            ], [
                'author_id'   => 1,
                'category_id' => $category_id,
                'title'       => $this->item->title,
                'body'        => $price_yesterday . '円 => ' . $price_today . '円',
                'excerpt'     => $this->item->asin,
                'slug'        => $slug,
                'image'       => $this->item->large_image,
                'status'      => Post::PUBLISHED,
            ]);

            if ($post->wasRecentlyCreated) {
                if ($this->item->users()->count() > 0) {
                    //ウォッチリスト版通知
                    Notification::send(
                        $this->item->users()->get(),
                        new WatchPriceAlertNotification($post)
                    );
                } else {
                    //ホーム版通知
                    $post->notify(new PriceAlertNotification());
                }
            }
        }
    }
}
