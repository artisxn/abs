
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

        <a href="{{ route('browse', $watch->browse_id) }}">{{ $watch->browse->title }}</a>

      </li>
    @endforeach
  </ul>
@endif