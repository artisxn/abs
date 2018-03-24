<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Model\History;
use App\Model\BrowseItem;
use App\Model\User;

use App\Notifications\CountInfoNotification;

class CountInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'abs:count-info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Count Info';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function handle()
    {
        $items_count = BrowseItem::distinct()->count('item_asin');
        info('Item count: ' . $items_count);
        cache()->forever('items_count', $items_count);

        $histories_count = History::count('id');
        info('History count: ' . $histories_count);
        cache()->forever('histories_count', $histories_count);

        $browses_count = BrowseItem::distinct()->count('browse_id');
        info('Browse count: ' . $browses_count);
        cache()->forever('browses_count', $browses_count);

        $user_count = User::count('id');
        info('User count: ' . $user_count);
        cache()->forever('user_count', $user_count);

        User::find(1)->notify(new CountInfoNotification(compact([
                'items_count',
                'histories_count',
                'browses_count',
                'user_count',
            ]))
        );
    }
}
