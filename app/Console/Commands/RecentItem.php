<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Repository\Item\ItemRepositoryInterface as Item;

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
     * @param Item $repository
     *
     * @return mixed
     */
    public function handle(Item $repository)
    {
        info('Recent Item');

        $items = $repository->recent();

        cache()->forever('recent_items', $items);
    }
}
