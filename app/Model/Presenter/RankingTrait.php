<?php

namespace App\Model\Presenter;

trait RankingTrait
{
    /**
     * @return string
     */
    public function ranking(): string
    {
        $rank = $this->histories()->take(2)->latest('day')->get();

        $today = $rank->first();
        $yesterday = $rank->last();

        if ($today->rank === $yesterday->rank) {
            return '';
        }

        if ($today->rank < $yesterday->rank) {
            return '<span uk-icon="icon: arrow-up"></span>';
        }

        if ($today->rank > $yesterday->rank) {
            return '<span uk-icon="icon: arrow-down"></span>';
        }
    }
}
