<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use App\Model\Post;

use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;

class WatchPriceAlertNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var Post
     */
    protected $post;

    /**
     * Create a new notification instance.
     *
     * @param Post|\Illuminate\Database\Eloquent\Model $post
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
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
        $via = ['database', WebPushChannel::class];

        if (config('feature.notify_mail')) {
            if ($notifiable->can('notify-mail') and $notifiable->notify_mail) {
                $via[] = 'mail';
            }
        }

        return $via;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if ($this->post->category_id === config('amazon.price_alert.up')) {
            $level = 'success';
            $line_move = '価格が上がりました。';
        } else {
            $level = 'error';
            $line_move = '価格が下がりました。';
        }

        $subject = '[' . config('app.name') . ']' . $this->post->title;

        return (new MailMessage)
            ->subject($subject)
            ->level($level)
            ->greeting($this->post->title)
            ->line($line_move)
            ->line($this->post->body)
            ->action(config('app.name') . 'で表示', route('asin', $this->post->excerpt));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     *
     * @return array
     */
    public function toDatabase($notifiable)
    {
        $cat = $this->post->category_id === config('amazon.price_alert.up') ? 'up' : 'down';

        return [
            'title'       => $this->post->title,
            'body'        => $this->post->body,
            'asin'        => $this->post->excerpt,
            'category_id' => $this->post->category_id,
            'category'    => $cat,
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

    /**
     * @param $notifiable
     * @param $notification
     *
     * @return mixed
     */
    public function toWebPush($notifiable, $notification)
    {
        return WebPushMessage::create()
                             ->id($notification->id)
                             ->title($this->post->title)
                             ->icon($this->post->image)
                             ->body($this->post->body)//                             ->action('View app', 'view_app')
            ;
    }
}
