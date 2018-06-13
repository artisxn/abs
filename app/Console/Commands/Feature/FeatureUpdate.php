<?php

namespace App\Console\Commands\Feature;

use Illuminate\Console\Command;

use App\Repository\Browse\BrowseRepositoryInterface as Browse;

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
    protected $description = 'Command description';

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
     * @param Browse $repository
     *
     * @return mixed
     */
    public function handle(Browse $repository)
    {
        $best_sellers = $repository->bestSellers(466280);
        $pre_orders = $repository->preOrder(637394);

        $this->info($pre_orders->count());
    }
}
