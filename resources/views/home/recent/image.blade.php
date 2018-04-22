@if(!empty($item->large_image))
  <div class="uk-card-media-top">
    <a href="{{ route('asin', $item->asin) }}">
      <div class="uk-cover-container uk-height-medium">

        <img src="{{ $item->large_image }}"
             border="0"
             title="{{abs_decode($item->title) }}"
             alt="{{abs_decode($item->title) }}"
        >
      </div>

    </a>
  </div>

@endif
