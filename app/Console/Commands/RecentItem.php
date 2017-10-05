<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Model\Item;

class RecentItem extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'abs:recent-item';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '最近のアイテム';

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
        info('Recent Item');

        $items = Item::latest('updated_at')
                     ->whereDoesntHave('browses', function ($query) {
                         $query->whereIn('browse_id', config('amazon.recent_except'));
                     })
                     ->take(24)
                     ->get();

        cache()->forever('recent_items', $items);
    }
}
