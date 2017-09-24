<h2 class="uk-heading-line uk-text-center"><span>ランダムブラウズ：{{ $browse_name or '' }}</span></h2>

@if(count($browse_items) > 0)
  <div class="uk-child-width-1-3@m uk-grid-small uk-grid-match" uk-grid>

    @foreach($browse_items as $item)
      @include('home.item.item')
    @endforeach

  </div>

@else
  <div class="uk-alert-warning" uk-alert>
    <a class="uk-alert-close" uk-close></a>
    <p>見つかりませんでした。(<a href="{{ route('browse', ['browse' => $browse_id]) }}">{{ $browse_id }}</a>)</p>
  </div>

@endif
