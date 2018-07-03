<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Model\History;
use App\Model\BrowseItem;
use App\Model\User;

use App\Notifications\CountInfoNotification;

class CountInfoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var bool
     */
    protected $notify;

    /**
     * Create a new job instance.
     *
     * @param bool $notify
     *
     * @return void
     */
    public function __construct(bool $notify)
    {
        $this->notify = $notify;
    }

    /**
     * Execute the job.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function handle()
    {
        $user_count = User::count('id');
        info('User count: ' . $user_count);
        cache()->forever('user_count', $user_count);

        $browses_count = BrowseItem::distinct()->count('browse_id');
        info('Browse count: ' . $browses_count);
        cache()->forever('browses_count', $browses_count);

        $items_count = BrowseItem::distinct()->count('item_asin');
        info('Item count: ' . $items_count);
        cache()->forever('items_count', $items_count);

        $histories_count = History::count('id');
        info('History count: ' . $histories_count);
        cache()->forever('histories_count', $histories_count);

        if ($this->notify) {
            User::find(1)->notify(new CountInfoNotification(compact([
                    'items_count',
                    'histories_count',
                    'browses_count',
                    'user_count',
                ]))
            );
        }
    }
}
