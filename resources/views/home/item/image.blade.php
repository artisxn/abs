@php
  if (!empty(array_get($item, 'LargeImage'))) {
    $img_size = 'LargeImage';
  } elseif (!empty(array_get($item, 'MediumImage'))) {
    $img_size = 'MediumImage';
  } elseif (!empty(array_get($item, 'SmallImage'))) {
    $img_size = 'SmallImage';
  }
@endphp

@unless(empty($img_size))
  <div class="uk-card-media-top">
    <a href="{{ route('asin', array_get($item, 'ASIN')) }}">
      <div class="uk-cover-container uk-height-medium">

        <img src="{{ array_get($item, $img_size . '.URL') }}"
             width="{{ array_get($item, $img_size . '.Width') }}"
             height="{{ array_get($item, $img_size . '.Height') }}"
             border="0"
             title="{{ de(array_get($item, 'ItemAttributes.Title')) }}"
             alt="{{ de(array_get($item, 'ItemAttributes.Title')) }}"
        >
      </div>

    </a>
  </div>
@endunless
