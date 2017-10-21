<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Jobs\PriceAlertJob;

class PriceAlertCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'abs:price-alert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '価格チェック';

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
        PriceAlertJob::dispatch();
    }
}
