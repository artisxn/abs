<?php

namespace App\Console\Commands\Mainte;

use Illuminate\Console\Command;

use App\Model\Post;

class DeleteOldPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'abs:delete-old-post';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'PriceAlertカテゴリーの古いポストを削除';

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
     * @return mixed
     */
    public function handle()
    {
        $items = Post::whereIn('category_id', [config('amazon.price_alert.up'), config('amazon.price_alert.down')])
                     ->whereDate('updated_at', '<', now()->subDays(7));

        info('Delete Old Post: ' . $items->count());

        $items->delete();
    }
}
