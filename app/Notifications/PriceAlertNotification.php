<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use App\Channels\MastodonChannel;

/**
 * Class PriceAlertNotification
 * @package App\Notifications
 */
class PriceAlertNotification extends Notification implements ShouldQueue
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
        //$notifiableはPost
        //ユーザーを指定せずに全体向けに通知

        $via = [];

        if (config('amazon-feature.mastodon')) {
            $via[] = MastodonChannel::class;
        }

        return $via;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     *
     * @return array
     */
    public function toMastodon($notifiable)
    {
        $url = route('asin', $notifiable->excerpt);

        $cat = $notifiable->category_id === config('amazon.price_alert.up') ? '⬆️' : '⬇️';

        $chart = '💹';

        return [
            'status' => "{$cat} {$notifiable->title}" . PHP_EOL . "{$chart} {$notifiable->body}" . PHP_EOL . $url,
        ];
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
