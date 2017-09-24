@auth

  @unless(auth()->user()->browseWatches()->whereBrowseId($browse)->exists())
    <form action="{{ route('browse-watch.store') }}" method="POST">
      {{ csrf_field() }}
      <input type="hidden" name="browse" value="{{ $browse }}">
      <button class="uk-button uk-button-primary">
        <span uk-icon="icon: star"></span>
        カテゴリーウォッチリストに追加
      </button>
    </form>
  @endunless

  @else

    @include('watch.amazon')

    @endauth
