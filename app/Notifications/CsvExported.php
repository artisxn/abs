<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;

class CsvExported extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $file;

    /**
     * Create a new notification instance.
     *
     * @param string $title
     * @param string $file
     *
     * @return void
     */
    public function __construct(string $title, string $file)
    {
        $this->title = $title;
        $this->file = $file;
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
        return ['database', WebPushChannel::class];
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
    public function toArray($notifiable)
    {
        return [
            'title' => $this->title,
            'file'  => $this->file,
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
                             ->title($this->title)
                             ->body('CSVの準備ができました。');
    }
}
