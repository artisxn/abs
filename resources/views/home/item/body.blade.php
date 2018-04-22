<div class="uk-card-body uk-padding-small">
  <h4 class="uk-card-title">
    <a href="{{ route('asin', array_get($item, 'ASIN')) }}" class="uk-link-text">
      {{ str_limit(abs_decode(array_get($item, 'ItemAttributes.Title')), 50) }}
    </a>
  </h4>

  <ul class="uk-list uk-list-divider">
    <li>在庫：
      {{abs_decode(array_get($item, 'Offers.Offer.OfferListing.Availability')) }}
    </li>

    <li>新品価格：
      {{abs_decode(array_get($item, 'OfferSummary.LowestNewPrice.FormattedPrice')) }}
    </li>

    <li>ランキング：{{ array_get($item, 'SalesRank') }}</li>

  </ul>
</div>
