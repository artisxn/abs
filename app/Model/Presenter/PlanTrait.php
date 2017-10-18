<?php

namespace App\Model\Presenter;

trait PlanTrait
{
    /**
     * @return string
     */
    public function plan()
    {
        if ($this->isAdmin()) {
            return 'enterprise';
        }

        if ($this->special_key === config('amazon.special_key_personal')) {
            return 'personal';
        }

        if ($this->special_key === config('amazon.special_key_business')) {
            return 'business';
        }

        return 'free';
    }

    /**
     * @return int
     */
    public function csvLimit()
    {
        $plan = $this->plan();

        $limits = [
            'enterprise' => 10000,
            'business'   => 10000,
            'personal'   => 10000,
            'free'       => 100,
        ];

        $limit = array_get($limits, $plan, config('amazon.csv_limit'));

        return $limit;
    }
}
