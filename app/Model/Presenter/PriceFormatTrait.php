<?php

namespace App\Model\Presenter;

trait PriceFormatTrait
{
    /**
     * @param int|null $price
     *
     * @return string
     */
    public function priceFormat(int $price = null): string
    {
        if (empty($price)) {
            $formatted = '';
        } else {
            $formatted = '￥ ' . number_format($price);
        }

        return $formatted;
    }
}
