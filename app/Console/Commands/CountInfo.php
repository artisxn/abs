<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Jobs\CountInfoJob;

class CountInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'abs:count-info {--no-notify}';

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
        CountInfoJob::dispatch((bool)!$this->option('no-notify'));
    }
}
