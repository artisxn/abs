<div class="uk-card-body uk-padding-small">
  <h4 class="uk-card-title">
    <a href="{{ route('asin', array_get($item, 'ASIN')) }}" class="uk-link-text">
      {{ str_limit(array_get($item, 'ItemAttributes.Title'), 30) }}
    </a>
  </h4>

  <ul class="uk-list uk-list-divider">
    <li>発売日：<span>
        {{ array_get($item, 'ItemAttributes.ReleaseDate') }}
      </span>
    </li>

    <li>価格：
      {{ array_get($item, 'OfferSummary.LowestNewPrice.FormattedPrice') }}
    </li>

    <li>ランキング：{{ array_get($item, 'SalesRank') }}</li>

  </ul>
</div>
