<?php

namespace App\Http\Controllers\Push;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use NotificationChannels\WebPush\PushSubscription;

class NotificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('last', 'dismiss');
    }

    /**
     * Get user's last notification from database.
     *
     * This method will be accessed by the service worker
     * so the user is not authenticated and it requires an endpoint.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return string
     */
    public function last(Request $request)
    {
        if (empty($request->endpoint)) {
            return response()->json('Endpoint missing.', 403);
        }

        /**
         * @var PushSubscription $subscription
         */
        $subscription = PushSubscription::findByEndpoint($request->endpoint);
        if (is_null($subscription)) {
            return response()->json('Subscription not found.', 404);
        }

        $notification = $subscription->user->unreadNotifications()->first();
        if (is_null($notification)) {
            return response()->json('Notification not found.', 404);
        }

        return $this->payload($notification);
    }

    /**
     * Mark the notification as read and dismiss it from other devices.
     *
     * This method will be accessed by the service worker
     * so the user is not authenticated and it requires an endpoint.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function dismiss(Request $request, $id)
    {
        if (empty($request->endpoint)) {
            return response()->json('Endpoint missing.', 403);
        }

        /**
         * @var PushSubscription $subscription
         */
        $subscription = PushSubscription::findByEndpoint($request->endpoint);
        if (is_null($subscription)) {
            return response()->json('Subscription not found.', 404);
        }

        /**
         * @var \Illuminate\Notifications\DatabaseNotification $notification
         */
        $notification = $subscription->user->notifications()->where('id', $id)->first();
        if (is_null($notification)) {
            return response()->json('Notification not found.', 404);
        }

        $notification->markAsRead();
    }

    /**
     * Get the payload for the given notification.
     *
     * @param  \Illuminate\Notifications\DatabaseNotification $notification
     *
     * @return string
     */
    protected function payload($notification)
    {
        //        $payload = [
        //            'title'      => isset($notifications->intro[0]) ? $notifications->intro[0] : null,
        //            'body'       => $this->format($notification),
        //            'actionText' => $notification->action_text ?: null,
        //            'actionUrl'  => $notification->action_url ?: null,
        //            'id'         => isset($notification->id) ? $notification->id : null,
        //        ];

        $payload = $notification->data;

        return json_encode($payload);
    }

    /**
     * Format the given notification.
     *
     * @param  \Illuminate\Notifications\DatabaseNotification $notification
     *
     * @return string
     */
    protected function format($notification)
    {
        $message = trim(implode(PHP_EOL . PHP_EOL, $notification->intro ?: []));
        $message .= PHP_EOL . PHP_EOL . trim(implode(PHP_EOL . PHP_EOL, $notification->outro ?: []));

        return trim($message);
    }
}
