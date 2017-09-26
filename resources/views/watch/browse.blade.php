<h3>カテゴリー</h3>
@if($browse_watches->count() > 0)
  <ul class="uk-list uk-list-striped">
    @foreach($browse_watches as $watch)
      <li>
        <div class="uk-float-right">
          <form action="{{ route('browse-watch.destroy', $watch->id) }}" method="POST">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button class="uk-button uk-button-danger uk-button-small">削除</button>
          </form>
        </div>

        <a href="{{ route('download.category', $watch->browse_id) }}"
           class="uk-button uk-button-default uk-button-small">CSV</a>
        <a href="{{ route('browse', $watch->browse_id) }}">
          {{ $watch->browse->title }}
          （{{ $watch->browse->items()->count() }}）
        </a>

      </li>
    @endforeach
  </ul>
@endif
