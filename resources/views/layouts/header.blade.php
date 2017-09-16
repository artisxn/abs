<header uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky">
  <nav class="uk-navbar-container uk-light abs-navbar-container" uk-navbar>
    <div class="uk-navbar-left">
      <a href="{{ route('index') }}" class="uk-navbar-item uk-logo">
        <span uk-icon="icon: bolt"></span>
        {{ config('app.name') }}
      </a>
    </div>
    <div class="uk-navbar-right">
      <ul class="uk-navbar-nav">
        <li><a href="{{ route('index') }}">ホーム</a></li>
        <li><a href="{{ route('browselist') }}">ブラウズリスト</a></li>
        @auth
          <li><a href="{{ route('logout') }}">ログアウト</a></li>
          @else
            <li>
              <a href="{{ route('login') }}">Amazonアカウントでログイン</a>
            </li>
            @endauth
      </ul>

    </div>
  </nav>
</header>
