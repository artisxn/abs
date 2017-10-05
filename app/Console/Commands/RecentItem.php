<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Repository\Item\ItemRepositoryInterface;

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
     * @param ItemRepositoryInterface $repository
     *
     * @return mixed
     */
    public function handle(ItemRepositoryInterface $repository)
    {
        info('Recent Item');

        $items = $repository->recent();

        cache()->forever('recent_items', $items);
    }
}
