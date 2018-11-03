<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use Revolution\Laravel\Notification\Mastodon\MastodonChannel;
use Revolution\Laravel\Notification\Mastodon\MastodonMessage;

use NotificationChannels\Discord\DiscordChannel;
use NotificationChannels\Discord\DiscordMessage;

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

        if (config('feature.mastodon')) {
            $via[] = MastodonChannel::class;
        }

        if (config('feature.discord')) {
            $via[] = DiscordChannel::class;
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

        $cat = $notifiable->category_id === config('amazon.price_alert.up') ? '⬆️' : '⬇️';

        $chart = '💹';

        $url = route('asin', $notifiable->excerpt);

        $status = "{$cat} {$title}" . PHP_EOL . "{$chart} {$notifiable->body}" . PHP_EOL . $url;

        return MastodonMessage::create($status)
                              ->domain(config('services.mastodon.domain'))
                              ->token(config('services.mastodon.token'));
    }

    public function toDiscord($notifiable)
    {
        $title = str_limit($notifiable->title, 300);

        $cat = $notifiable->category_id === config('amazon.price_alert.up') ? '⬆️' : '⬇️';

        $color = $notifiable->category_id === config('amazon.price_alert.up') ? 13632027 : 553968;

        $chart = '💹';

        $url = route('asin', $notifiable->excerpt);

        $status = "{$cat} {$title}" . PHP_EOL . "{$chart} {$notifiable->body}" . PHP_EOL . $url;

        $embed = [
            'title'       => "{$cat} {$title}",
            'description' => "{$chart} {$notifiable->body}",
            'url'         => $url,
            'color'       => $color,
            'thumbnail'   => [
                'url' => $notifiable->image,
            ],
        ];

        return DiscordMessage::create($url, $embed);
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
