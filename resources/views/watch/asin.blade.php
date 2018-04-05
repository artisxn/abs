<h3>ASIN({{ $asin_watches->total() }})</h3>


@if($asin_watches->count() > 0)

  {{ $asin_watches->links() }}

  @feature('csv_download')
  <a href="{{ route('download.asin') }}" class="uk-button uk-button-default">CSVでダウンロード</a>
  @endfeature

  <ul class="uk-list uk-list-striped">
    @foreach($asin_watches as $watch)
      <li>
        {!! $watch->ranking() !!}
        <a href="{{ route('asin', $watch->asin_id) }}">{{ de($watch->item->title) ?? $watch->asin_id}}</a>

      </li>
    @endforeach
  </ul>

  {{ $asin_watches->links() }}
@endif
