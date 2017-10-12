<header uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky">
  <nav class="uk-navbar-container uk-light abs-navbar-container" uk-navbar>
    <div class="uk-navbar-left">
      <a href="{{ route('index') }}" class="uk-navbar-item uk-logo">
        <span uk-icon="icon: bolt"></span>
        {{ config('app.name') }}
      </a>
      <ul class="uk-navbar-nav">
        <li><a href="{{ route('index') }}">ホーム</a></li>
        <li><a href="{{ route('usage') }}">使い方</a></li>
        <li><a href="{{ route('browselist') }}">ブラウズリスト</a></li>
      </ul>
    </div>

    @guest
      <div class="uk-navbar-right">
        <ul class="uk-navbar-nav">
          <li>
            <a href="{{ route('login') }}" rel="nofollow">
              <i class="fa fa-amazon" aria-hidden="true"></i>
              Amazonアカウントでログイン</a>
          </li>
        </ul>
      </div>
    @endguest
  </nav>

  @auth
    <nav class="uk-navbar-container uk-light abs-navbar-container-sub uk-padding-large uk-padding-remove-vertical"
         uk-navbar>
      <div class="uk-navbar-left">
        <ul class="uk-navbar-nav">
          <li>
            <a href="{{ route('watch') }}">
              <span uk-icon="icon: list"></span>
              ウォッチリスト
            </a>
          </li>
          @can('export')
            <li>
              <a href="{{ route('export.index') }}">
                <span uk-icon="icon: download"></span>
                エクスポート
              </a>
            </li>
          @endcan
          <li>
            <a href="#">
              <span uk-icon="icon: settings"></span>
              設定
            </a>
          </li>
        </ul>

      </div>

      <div class="uk-navbar-right">
        <ul class="uk-navbar-nav">
          <li><a href="{{ route('logout') }}">ログアウト</a></li>
        </ul>
      </div>
    </nav>
  @endauth
</header>
