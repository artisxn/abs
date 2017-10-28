<?php

namespace App\Model\Presenter;

use JsonLd\Context;
use JsonLd\ContextTypes\Product;

trait ItemJsonTrait
{
    public function jsonLd()
    {
        $ava = data_get($this->offers->offers, 'Offer.OfferListing.Availability');
        if (str_contains($ava, '在庫あり')) {
            $availability = 'http://schema.org/InStock';
        } else {
            $availability = null;
        }

        $context = Context::create(Product::class, [
            'name'  => $this->title,
            'brand' => data_get($this->item_attribute->attributes, 'Brand'),
            'sku'   => data_get($this->item_attribute->attributes, 'SKU'),

            'image' => $this->large_image,
            'url'   => $this->detail_url,
            'mpn'   => data_get($this->item_attribute->attributes, 'MPN'),

            'category' => data_get($this->item_attribute->attributes, 'Binding'),
            'model'    => data_get($this->item_attribute->attributes, 'Model'),

            'offers' => [
                'price'         => data_get($this->offers->offers, 'Offer.OfferListing.Price.Amount'),
                'priceCurrency' => data_get($this->offers->offers, 'Offer.OfferListing.Price.CurrencyCode'),
                'itemCondition' => data_get($this->offers->offers, 'Offer.OfferListing.OfferAttributes.Condition'),
                'availability'  => $availability,
            ],
        ]);

        return $context;
    }
}
