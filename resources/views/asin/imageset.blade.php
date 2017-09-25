@php
  $image_sets = array_get($item, 'ImageSets.ImageSet');
  if(array_has($image_sets, '@attributes')){
    $image_sets =[$image_sets];
  }
@endphp

@unless(empty($image_sets))
  <div class="uk-card-body">

    <h4 class="uk-heading-line"><span>画像</span></h4>

    <div uk-lightbox>

      @foreach($image_sets as $image_set)
        @unless(empty(array_get($image_set, 'HiResImage.URL')))

          <a href="{{ array_get($image_set, 'HiResImage.URL') }}">
            <div class="uk-cover-container uk-height-medium">
              <img src="{{ array_get($image_set, 'HiResImage.URL') }}"
                   alt=""
                   itemprop="image"
                   uk-cover>
            </div>
          </a>

        @endunless
      @endforeach

    </div>

  </div>
@endunless
