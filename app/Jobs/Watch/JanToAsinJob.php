<?php

namespace App\Jobs\Watch;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use AmazonProduct;

class JanToAsinJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array
     */
    public $jan_lists;

    /**
     * @var int
     */
    protected $user_id;

    /**
     * Create a new job instance.
     *
     * @param array $jan_lists
     * @param int   $user_id
     *
     */
    public function __construct(array $jan_lists, int $user_id)
    {
        $this->jan_lists = $jan_lists;
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        info(self::class);

        if (count($this->jan_lists) > 10) {
            logger()->error(count($this->jan_lists));

            return;
        }

        $results = rescue(function () {
            $results = AmazonProduct::setIdType('EAN')->items($this->jan_lists);
            AmazonProduct::setIdType('ASIN');

            return $results;
        }, []);

        $items = array_get($results, 'Items.Item');

        //        info(count($items));

        if (count($items) === 0) {
            return;
        }

        foreach ($items as $key => $item) {
            $asin = array_get($item, 'ASIN');

            if (!empty($asin)) {
                SaveJob::dispatch($item, $this->user_id);
            }
        }
    }
}
