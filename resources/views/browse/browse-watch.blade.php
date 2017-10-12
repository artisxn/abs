@auth
  @php
    $browse_watch = optional(auth()->user()->browseWatches())->whereBrowseId($browse_id);
  @endphp

  @unless(optional($browse_watch)->exists())
    <form action="{{ route('watch.browse.store') }}" method="POST">
      {{ csrf_field() }}
      <input type="hidden" name="browse" value="{{ $browse_id }}">
      <button class="uk-button uk-button-primary">
        <span uk-icon="icon: star"></span>
        カテゴリーウォッチリストに追加
      </button>
    </form>
  @else
    <form
      action="{{ route('watch.browse.destroy', optional($browse_watch->first())->id) }}"
      method="POST">
      {{ method_field('DELETE') }}
      {{ csrf_field() }}
      <button class="uk-button uk-button-danger">カテゴリーウォッチリストから削除</button>
    </form>

  @endunless

  @else

    @include('watch.amazon')

    @endauth
