@if(isset($histories) and count($histories) > 0)
  @auth
    <div class="uk-card-body" uk-margin>
      <form action="{{ route('watch.store') }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="asin" value="{{ array_get($item, 'ASIN') }}">
        <button class="uk-button uk-button-default uk-width-1-1">ウォッチリストに追加</button>

      </form>
    </div>
    @else
      <div class="uk-card-body" uk-margin>

        <div class="uk-alert-danger" uk-alert>
          <p>
            <a href="{{ route('login') }}">Amazonアカウントでログイン</a>するとウォッチリストに追加機能が使えます。
          </p>
        </div>
      </div>

      @endauth
    @endif
