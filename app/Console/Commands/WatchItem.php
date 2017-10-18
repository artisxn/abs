<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Jobs\GetItemsJob;

use App\Model\Watch;

class WatchItem extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'abs:watch-item';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ウォッチリストのアイテム情報を更新';

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
        $asins = Watch::groupBy('asin_id')->latest()->take(1000)->pluck('asin_id');

        info('Watch Item: ' . $asins->count());

        $delay = 1;

        foreach ($asins->chunk(10) as $items) {
            GetItemsJob::dispatch($items->toArray())->delay(now()->addMinutes($delay * 3));

            $delay++;
        }
    }
}
