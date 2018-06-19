<?php

namespace App\Console\Commands\Feature;

use Illuminate\Console\Command;

use App\Jobs\Feature\UpdateJob;

class FeatureUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'abs:feature';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update feature page cache';

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
        UpdateJob::dispatch();
    }
}
