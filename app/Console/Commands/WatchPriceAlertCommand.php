<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Jobs\Watch\WatchPriceAlertJob;

class WatchPriceAlertCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'abs:price-alert-watch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ウォッチリストの価格チェック';

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
        WatchPriceAlertJob::dispatch();
    }
}
