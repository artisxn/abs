<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;

use Mastodon;

class MastodonChannel
{
    /**
     * 指定された通知の送信
     *
     * @param  mixed                                  $notifiable
     * @param  \Illuminate\Notifications\Notification $notification
     *
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toMastodon($notifiable);

        $status = array_get($message, 'status');

        if (empty($status)) {
            return;
        }

        $response = Mastodon::domain(config('services.mastodon.domain'))
                            ->token(config('services.mastodon.token'))
                            ->createStatus($status);
    }
}
