@php
  $features = data_get($item, 'ItemAttributes.Feature', []);
  $features = array_wrap($features);
@endphp

@if(filled($features))
  <div class="uk-card-body">

    <h4 class="uk-heading-line"><span>特徴</span></h4>

    <ul class="uk-list uk-list-bullet">
      @foreach($features as $feature)
        <li>{!! $feature !!}</li>
      @endforeach
    </ul>
  </div>
@endif
