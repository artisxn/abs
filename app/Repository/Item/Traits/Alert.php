<?php

namespace App\Repository\Item\Traits;

trait Alert
{
    /**
     * @inheritDoc
     */
    public function priceAlert()
    {
        return $this->item->latest('updated_at')
                          ->limit(config('amazon.price_alert_limit'))
                          ->whereNotNull('rank')
                          ->where('rank', '<', 500)
                          ->has('histories', '>', 5)
                          ->whereHas('histories', function ($query) {
                              $query->whereNotNull('lowest_new_price');
                          })
                          ->doesntHave('watches')
                          ->get();
    }
}
