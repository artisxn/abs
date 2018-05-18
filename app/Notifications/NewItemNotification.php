<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use Revolution\Laravel\Notification\Mastodon\MastodonChannel;
use Revolution\Laravel\Notification\Mastodon\MastodonMessage;

class NewItemNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        //$notifiableはItem

        $via = [];

        if (!config('feature.mastodon')) {
            return $via;
        }

        //除外カテゴリーなら除く
        if (!$notifiable->browses->every(function ($browse) {
            return !in_array($browse->id, config('amazon.delete_category'));
        })) {
            return $via;
        };

        //ランキングが一定以内のみ
        if ($notifiable->rank > 0 and $notifiable->rank <= config('amazon.new_item_rank')) {
            $via[] = MastodonChannel::class;
        }

        return $via;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     *
     * @return MastodonMessage
     */
    public function toMastodon($notifiable)
    {
        $title = str_limit($notifiable->title, 300);

        $rank = $notifiable->rank;

        $url = route('asin', $notifiable->asin);

        $status = "【新着】(ランキング:{$rank}) {$title}" . PHP_EOL . $url;

        return MastodonMessage::create($status)
                              ->domain(config('services.mastodon.domain'))
                              ->token(config('services.mastodon.token'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
