<?php

namespace App\Model\Presenter;

use JsonLd\Context;
use JsonLd\ContextTypes\Product;

trait ItemJsonTrait
{
    public function jsonLd()
    {
        $context = cache()->remember('json_ld.' . $this->asin, 60 * 12, function () {
            return Context::create(Product::class, [
                'name'  => $this->title,
                'brand' => data_get($this->item_attribute->attributes, 'Brand'),
                'image' => $this->large_image,
                'url'   => $this->detail_url,

                'offers' => [
                    'price'         => data_get($this->offers->offers, 'Offer.OfferListing.Price.Amount'),
                    'priceCurrency' => data_get($this->offers->offers, 'Offer.OfferListing.Price.CurrencyCode'),
                    'itemCondition' => data_get($this->offers->offers, 'Offer.OfferListing.OfferAttributes.Condition'),
                    'availability'  => data_get($this->offers->offers, 'Offer.OfferListing.Availability'),
                ],
            ]);
        });

        return $context;
    }
}
