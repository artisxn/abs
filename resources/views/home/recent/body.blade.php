<div class="uk-card-body uk-padding-small">
  <h4 class="uk-card-title">
    <a href="{{ route('asin', $item->asin) }}" class="uk-link-text">
      {{ str_limit(de($item->title), 100) }}
    </a>
  </h4>

  {{--<ul class="uk-list uk-list-divider">--}}
    {{--<li>在庫：--}}
      {{--{{ array_get($item->offers, 'Offer.OfferListing.Availability') }}--}}
    {{--</li>--}}

    {{--<li>新品価格：--}}
      {{--{{ array_get($item->offer_summary, 'LowestNewPrice.Amount') }}--}}
    {{--</li>--}}
  {{--</ul>--}}
</div>
