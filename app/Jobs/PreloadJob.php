<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class PreloadJob
 *
 * ブラウズや検索結果のASINからアイテム情報をキューで取得する
 *
 * @package App\Jobs
 */
class PreloadJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array
     */
    protected $items;

    /**
     * Create a new job instance.
     *
     * @param array $items
     *
     * @return void
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $delay = 1;

        foreach ($this->items as $asin) {
            if (!empty($asin)) {
                ItemJob::dispatch($asin)->delay(now()->addMinutes($delay));
            }

            $delay++;
        }
    }
}
