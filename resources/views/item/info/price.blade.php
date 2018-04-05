<li itemscope itemtype="http://schema.org/Offer">新品価格：
  <span itemprop="priceCurrency"
        content="{{ data_get($item, 'OfferSummary.LowestNewPrice.CurrencyCode') }}"></span>
  <span itemtype="http://schema.org/Offer" itemprop="price"
        content="{{ data_get($item, 'OfferSummary.LowestNewPrice.Amount') }}"></span>
  {{ de(data_get($item, 'OfferSummary.LowestNewPrice.FormattedPrice')) }}
</li>

<li>中古価格：
  {{ de(data_get($item, 'OfferSummary.LowestUsedPrice.FormattedPrice')) }}
</li>

<li>定価：
  {{ de(data_get($item, 'ItemAttributes.ListPrice.FormattedPrice')) }}
</li>
