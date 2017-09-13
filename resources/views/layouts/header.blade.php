<header>
  <nav class="uk-navbar-container" uk-navbar>
    <div class="uk-navbar-left uk-logo">
      <a href="{{ route('index') }}">{{ config('app.name') }}</a>
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
