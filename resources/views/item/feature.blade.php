@php
  $features = array_get($item, 'ItemAttributes.Feature');
@endphp

@unless(empty($features))
  <div class="uk-card-body">

    <h4 class="uk-heading-line"><span>特徴</span></h4>

    <ul class="uk-list uk-list-bullet">
      @foreach($features as $feature)
        <li>{{ $feature }}</li>
      @endforeach
    </ul>
  </div>
@endunless
