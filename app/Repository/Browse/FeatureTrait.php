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
        return $this->browse->find($browse)
                            ->items()
                            ->whereBetween('rank', [1, 101])
                            ->orderBy('rank')
                            ->get();
    }

    /**
     * @param int $browse
     *
     * @return mixed
     */
    public function preOrder(int $browse)
    {
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
    }
}
