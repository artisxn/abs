
<div class="uk-card-header uk-card-primary">
  <h2 class="uk-card-title">
    <a href="{{ route('asin', array_get($item, 'ASIN')) }}">
      <span itemprop="name">{{ array_get($item, 'ItemAttributes.Title') }}</span>
    </a>
  </h2>
</div>
