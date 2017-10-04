<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Model\Item;
use App\Model\History;
use App\Model\Browse;

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
     * @return mixed
     */
    public function handle()
    {
        cache()->forever('items_count', Item::count('asin'));
        cache()->forever('histories_count', History::count('id'));

        $browses_count = Browse::count('id');
        info('Browse count: ' . $browses_count);
        cache()->forever('browses_count', $browses_count);
    }
}
