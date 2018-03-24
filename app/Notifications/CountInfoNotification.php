<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use Revolution\Laravel\Notification\Mastodon\MastodonChannel;
use Revolution\Laravel\Notification\Mastodon\MastodonMessage;

class CountInfoNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var array
     */
    protected $info;

    /**
     * Create a new notification instance.
     *
     * @param array $info
     *
     * @return void
     */
    public function __construct($info)
    {
        $this->info = $info;
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
        $via = [];

        if (config('feature.mastodon')) {
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
        $status = [
            'ASINカウント：' . data_get($this->info, 'items_count'),
            '履歴カウント：' . data_get($this->info, 'histories_count'),
            'カテゴリーカウント：' . data_get($this->info, 'browses_count'),
            'ユーザーカウント：' . data_get($this->info, 'user_count'),
        ];

        return MastodonMessage::create(implode(PHP_EOL, $status))
                              ->domain(config('services.mastodon.domain'))
                              ->token(config('services.mastodon.token'));
    }
}
