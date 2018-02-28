@auth
  @php
    $watch = optional(auth()->user()->watches())->whereAsinId(array_get($item, 'ASIN'));
  @endphp

  @unless(optional($watch)->exists())

    <form action="{{ route('watch.asin.store') }}" method="POST">
      {{ csrf_field() }}
      <input type="hidden" name="asin" value="{{ data_get($item, 'ASIN') }}">
      <button class="uk-button uk-button-primary">
        <span uk-icon="icon: star"></span>
        ASINウォッチリストに追加
      </button>
    </form>
  @else
    <form action="{{ route('watch.asin.destroy', optional($watch->first())->id) }}" method="POST">
      {{ method_field('DELETE') }}
      {{ csrf_field() }}
      <button class="uk-button uk-button-danger">ASINウォッチリストから削除</button>
    </form>
  @endunless
@else

  @include('watch.amazon')

@endauth
