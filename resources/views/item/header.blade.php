
<div class="uk-card-header uk-card-primary">
  <h2 class="uk-card-title">
    <a href="{{ route('asin', data_get($item, 'ASIN')) }}">
      <span itemprop="name">{{ data_get($item, 'ItemAttributes.Title') }}</span>
    </a>
  </h2>
</div>
