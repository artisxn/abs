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
        /**
         * @var MastodonMessage $message
         */
        $message = $notification->toMastodon($notifiable);

        $status = $message->status;

        if (empty($status)) {
            return;
        }

        $domain = $message->domain;
        if (empty($domain)) {
            $domain = config('services.mastodon.domain');
        }
        if (empty($domain)) {
            return;
        }

        $token = $message->token;
        if (empty($token)) {
            $token = config('services.mastodon.token');
        }
        if (empty($token)) {
            return;
        }

        $response = Mastodon::domain($domain)
                            ->token($token)
                            ->createStatus($status);
    }
}
