<?php

namespace App\Jobs\Feature;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Repository\Browse\BrowseRepositoryInterface as Browse;

class UpdateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @param Browse $repository
     *
     * @return void
     *
     * @throws \Exception
     */
    public function handle(Browse $repository)
    {
        cache()->forget('feature.pre_order.637394');

        $pre_orders = $repository->preOrder(637394);
        info($pre_orders->count());

        //        $best_sellers = $repository->bestSellers(466280);
        //        info($best_sellers->count());
    }
}
