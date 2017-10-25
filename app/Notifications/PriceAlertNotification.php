<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use App\Model\Post;

/**
 * TODO:WebPushにも対応
 *
 * Class PriceAlertNotification
 * @package App\Notifications
 */
class PriceAlertNotification extends Notification
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
        return ['database'];
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
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
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
}
