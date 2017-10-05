<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Model\History;
use App\Model\Browse;

use App\Repository\Item\ItemRepositoryInterface as Item;

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
     * @param Item $item
     *
     * @return mixed
     */
    public function handle(Item $item)
    {
        $items_count = $item->count();
        info('Item count: ' . $items_count);
        cache()->forever('items_count', $items_count);

        $histories_count = History::count('id');
        info('History count: ' . $histories_count);
        cache()->forever('histories_count', $histories_count);

        $browses_count = Browse::count('id');
        info('Browse count: ' . $browses_count);
        cache()->forever('browses_count', $browses_count);
    }
}
