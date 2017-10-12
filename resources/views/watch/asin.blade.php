<h3>ASIN</h3>


@if($asin_watches->count() > 0)

  {{ $asin_watches->links() }}

  <a href="{{ route('download.asin') }}" class="uk-button uk-button-default">CSVでダウンロード</a>

  <ul class="uk-list uk-list-striped">
    @foreach($asin_watches as $watch)
      <li>
        {!! $watch->ranking() !!}
        <a href="{{ route('asin', $watch->asin_id) }}">{{ $watch->item->title or $watch->asin_id}}</a>

      </li>
    @endforeach
  </ul>

  {{ $asin_watches->links() }}
@endif
