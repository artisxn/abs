<?php

namespace App\Console\Commands\Mws;

use Illuminate\Console\Command;

use App\Jobs\Mws\GetPricingJob;

class AsinCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'abs:mws-asin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'MWSテスト';

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
        dispatch_now(new GetPricingJob);
    }
}
