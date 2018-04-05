@if(!empty($item->large_image))
  <div class="uk-card-media-top">
    <a href="{{ route('asin', $item->asin) }}">
      <div class="uk-cover-container uk-height-medium">

        <img src="{{ $item->large_image }}"
             border="0"
             title="{{ de($item->title) }}"
             alt="{{ de($item->title) }}"
        >
      </div>

    </a>
  </div>

@endif
