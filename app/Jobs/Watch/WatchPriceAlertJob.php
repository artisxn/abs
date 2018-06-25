<?php

namespace App\Jobs\Watch;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Model\Watch;

use App\Jobs\PriceCheckJob;

class WatchPriceAlertJob implements ShouldQueue
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
     * @return void
     */
    public function handle()
    {
        info(self::class);

        $watches = Watch::groupBy('asin_id')->cursor();

        foreach ($watches as $watch) {
            PriceCheckJob::dispatch($watch->item);
        }

        //        info(self::class . ': End');
    }
}
