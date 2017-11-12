<?php

namespace App\Notifications\World;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

use NotificationChannels\Chatwork\ChatworkInformation;
use NotificationChannels\Chatwork\ChatworkChannel;

class InfoNotification extends Notification
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
        return [ChatworkChannel::class];
    }

    /**
     * @param mixed $notifiable
     *
     * @return ChatworkInformation
     */
    public function toChatwork($notifiable)
    {
        $oldest = $notifiable->watches()->oldest('updated_at')->first()->updated_at;

        $watch_count = $notifiable->watches()->count();

        $world_items_count = $notifiable->worldItems()->count();

        $yesterday = $notifiable->worldItems()
                                ->whereDate('world_items.created_at', now()->subDay()->toDateString())
                                ->count();

        $message = [
            '【一番古い更新時間】' . $oldest,
            '【ウォッチリスト】' . $watch_count,
            '【ワールドアイテム】' . $world_items_count,
            '【昨日の新着数】' . $yesterday,
        ];

        return (new ChatworkInformation())
            ->token(config('feature.chatwork_token'))
            ->roomId(config('feature.chatwork_room'))
            ->informationTitle('レポート')
            ->informationMessage(implode(PHP_EOL, $message));
    }
}
