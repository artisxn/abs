<?php

namespace App\Repository\Browse;

trait FeatureTrait
{
    /**
     * @param int $browse
     *
     * @return mixed
     */
    public function bestSellers(int $browse)
    {
        return cache()->remember('feature.bestsellers.' . $browse, 60, function () use ($browse) {
            return $this->browse->find($browse)
                                ->items()
                                ->whereBetween('rank', [1, 100])
                                ->orderBy('rank')
                                ->get();
        });

    }

    /**
     * @param int $browse
     *
     * @return mixed
     */
    public function preOrder(int $browse)
    {
        return cache()->remember('feature.pre_order.' . $browse, 60, function () use ($browse) {
            return $this->browse->find($browse)
                         ->items()
                         ->whereNotNull('rank')
                         ->with(['availability'])
                         ->whereHas('availability', function ($query) {
                             $query->where('availability', '近日発売　予約可');
                         })
                         ->orderBy('rank')
                         ->limit(100)
                         ->get();
        });
    }
}
