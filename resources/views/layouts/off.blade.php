<div id="abs-off-canvas" uk-offcanvas="mode: push; overlay: true">
  <div class="uk-offcanvas-bar">
    <button class="uk-offcanvas-close" type="button" uk-close></button>

    <ul class="uk-nav uk-nav-default">
      <li class="uk-nav-header">
        <a href="{{ route('index') }}" class="uk-logo">
          <span uk-icon="icon: bolt"></span>
          {{ config('app.name') }}
        </a>
      </li>

      <li><a href="{{ route('index') }}">ホーム</a></li>
      @feature('plan')
      <li><a href="{{ route('plan') }}">プラン</a></li>
      @endfeature
      <li><a href="{{ route('usage') }}">使い方</a></li>
      <li><a href="{{ route('browselist') }}">ブラウズリスト</a></li>

      @guest
        <li>
          <a href="{{ route('login') }}" rel="nofollow">
            <i class="fa fa-amazon" aria-hidden="true"></i>
            Amazonアカウントでログイン</a>
        </li>
      @endguest

      <li class="uk-nav-divider"></li>

      @auth
        <li>
          <a href="{{ route('watch') }}">
            <span uk-icon="icon: list"></span>
            ウォッチリスト
          </a>
        </li>
        @feature('world')
        <li>
          <a href="{{ route('world.index') }}">
            <span uk-icon="icon: world"></span>
            ワールド
          </a>
        </li>
        @endfeature
        @feature('csv_import')
        @can('csv-import')
          <li>
            <a href="{{ route('import.index') }}">
              <span uk-icon="icon: upload"></span>
              インポート
            </a>
          </li>
        @endcan
        @endfeature
        @can('export')
          <li>
            <a href="{{ route('export.index') }}">
              <span uk-icon="icon: download"></span>
              エクスポート
            </a>
          </li>
        @endcan
        <li>
          <a href="{{ route('notifications') }}">
            <span uk-icon="icon: bell"></span>
            通知
            <span class="uk-badge">
              {{ auth()->user()->unreadNotifications()->count() }}
              </span>
          </a>
        </li>
        <li>
          <a href="{{ route('settings.index') }}">
            <span uk-icon="icon: settings"></span>
            設定
          </a>
        </li>

        <li class="uk-nav-divider"></li>

        <li><a href="{{ route('logout') }}">ログアウト</a></li>

      @endauth

    </ul>
  </div>
</div>
