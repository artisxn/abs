<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Model\History;

class CreateHistoryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array
     */
    protected $item;

    /**
     * Create a new job instance.
     *
     * @param array $item
     */
    public function __construct(array $item)
    {
        $this->item = $item;
    }

    /**
     * Execute the job.
     *
     * @param History $history
     *
     * @return void
     */
    public function handle(History $history)
    {
        info(self::class);

        $asin_id = array_get($this->item, 'ASIN');

        if (empty($asin_id)) {
            return;
        }

        $day = today();

        $rank = array_get($this->item, 'SalesRank');
        $availability = array_get($this->item, 'Offers.Offer.OfferListing.Availability');
        $lowest_new_price = array_get($this->item, 'OfferSummary.LowestNewPrice.Amount');
        $lowest_used_price = array_get($this->item, 'OfferSummary.LowestUsedPrice.Amount');
        $total_new = array_get($this->item, 'OfferSummary.TotalNew');
        $total_used = array_get($this->item, 'OfferSummary.TotalUsed');

        $history->updateOrCreate([
            'asin_id' => $asin_id,
            'day'     => $day,
        ], compact([
            'rank',
            'availability',
            'lowest_new_price',
            'lowest_used_price',
            'total_new',
            'total_used',
        ]));
    }
}
