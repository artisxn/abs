<h3>ASIN</h3>

@if($asin_watches->count() > 0)

  <a href="{{ route('download.asin') }}" class="uk-button uk-button-default">CSVでダウンロード</a>

  <ul class="uk-list uk-list-striped">
    @foreach($asin_watches as $watch)
      <li>

        @if(request()->has('mode'))
          <div class="uk-float-right">
            <form action="{{ route('asin-watch.destroy', $watch->id) }}" method="POST">
              {{ method_field('DELETE') }}
              {{ csrf_field() }}
              <button class="uk-button uk-button-danger uk-button-small">削除</button>
            </form>
          </div>
        @endif

        {!! $watch->ranking() !!}
        <a href="{{ route('asin', $watch->asin_id) }}">{{ $watch->item->title or $watch->asin_id}}</a>

      </li>
    @endforeach
  </ul>
@endif
