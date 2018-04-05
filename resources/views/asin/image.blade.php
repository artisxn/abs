@unless(empty($asin_item->large_image))
  <div class="uk-card-media uk-margin-large-left">
    <a href="{{ $asin_item->detail_url }}" target="_blank" rel="nofollow noopener">
      <img src="{{ $asin_item->large_image }}"
           border="0"
           title="{{ de($asin_item->title) }}"
           alt="{{ de($asin_item->title) }}"
           itemprop="image">
    </a>
  </div>
@endunless
