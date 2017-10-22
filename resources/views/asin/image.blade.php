@unless(empty($asin_item->large_image))
  <div class="uk-card-media uk-margin-large-left">
    <a href="{{ $asin_item->detail_url }}" target="_blank" rel="nofollow">
      <img src="{{ $asin_item->large_image }}"
           border="0"
           title="{{ $asin_item->title }}"
           alt="{{ $asin_item->title }}"
           itemprop="image">
    </a>
  </div>
@endunless
