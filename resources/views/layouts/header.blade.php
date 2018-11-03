<header uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky">
  <nav class="uk-navbar-container uk-light abs-navbar-container" uk-navbar>
    <div class="uk-navbar-left">
      <a href="{{ route('index') }}" class="uk-navbar-item uk-logo">
        <span uk-icon="icon: bolt"></span>
        {{ config('app.name') }}
      </a>
      <ul class="uk-navbar-nav uk-visible@s">
        <li><a href="{{ route('index') }}">ホーム</a></li>
        @feature('feature_page')
        <li>
          <a href="#">特集</a>
          <div class="uk-navbar-dropdown">
            <ul class="uk-nav uk-navbar-dropdown-nav">
              @feature('feature_book')
              <li><a href="{{ route('feature.book') }}">コミック</a></li>
              @endfeature
              @feature('feature_game')
              <li><a href="{{ route('feature.game') }}">テレビゲーム</a></li>
              @endfeature
            </ul>
          </div>
        </li>
        @endfeature

        @feature('plan')
        <li><a href="{{ route('plan') }}">プラン</a></li>
        @endfeature
        <li><a href="{{ route('usage') }}">使い方</a></li>
        <li><a href="{{ route('browselist') }}">ブラウズリスト</a></li>
        <li><a href="{{ config('feature.discord_url') }}" target="_blank">Discord</a></li>
      </ul>
    </div>

    <div class="uk-navbar-right">
      <ul class="uk-navbar-nav">
        @guest
          <li>
            <a href="{{ route('login') }}" rel="nofollow">
              <i class="fa fa-amazon" aria-hidden="true"></i>
              Amazonアカウントでログイン</a>
          </li>
        @endguest

        <li class="uk-hidden@s">
          <a class="uk-navbar-toggle" uk-navbar-toggle-icon uk-toggle="target: #abs-off-canvas"></a>
        </li>
      </ul>
    </div>
  </nav>

  @include('layouts.off')

  @auth
    <nav
      class="uk-navbar-container uk-light abs-navbar-container-sub uk-padding-large uk-padding-remove-vertical uk-visible@s"
      uk-navbar>
      <div class="uk-navbar-left uk-flex-nowrap">
        <ul class="uk-navbar-nav">
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

          @feature('csv_download')
          @can('export')
            <li>
              <a href="{{ route('export.index') }}">
                <span uk-icon="icon: download"></span>
                エクスポート
              </a>
            </li>
          @endcan
          @endfeature

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
        </ul>
      </div>

      <div class="uk-navbar-right uk-flex-nowrap">
        <ul class="uk-navbar-nav">
          <li><a href="{{ route('logout') }}">ログアウト</a></li>
        </ul>
      </div>
    </nav>
  @endauth
</header>
