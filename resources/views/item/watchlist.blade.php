@auth
  @unless(auth()->user()->watches()->whereAsinId(array_get($item, 'ASIN'))->exists())

    <form action="{{ route('asin-watch.store') }}" method="POST">
      {{ csrf_field() }}
      <input type="hidden" name="asin" value="{{ array_get($item, 'ASIN') }}">
      <button class="uk-button uk-button-primary">
        <span uk-icon="icon: star"></span>
        ASINウォッチリストに追加
      </button>
    </form>
  @endunless
  @else

    @include('watch.amazon')

    @endauth
