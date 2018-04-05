@php
  if (!empty(data_get($item, 'LargeImage'))) {
    $img_size = 'LargeImage';
  } elseif (!empty(data_get($item, 'MediumImage'))) {
    $img_size = 'MediumImage';
  } elseif (!empty(data_get($item, 'SmallImage'))) {
    $img_size = 'SmallImage';
  }
@endphp

@unless(empty($img_size))
  <div class="uk-card-media uk-margin-large-left">
    <a href="{{ data_get($item, 'DetailPageURL') }}" target="_blank" rel="nofollow noopener">
      <img src="{{ data_get($item, $img_size . '.URL') }}"
           width="{{ data_get($item, $img_size . '.Width') }}"
           height="{{ data_get($item, $img_size . '.Height') }}"
           border="0"
           title="{{ de(data_get($item, 'ItemAttributes.Title')) }}"
           alt="{{ de(data_get($item, 'ItemAttributes.Title')) }}"
           itemprop="image">
    </a>
  </div>
@endunless
