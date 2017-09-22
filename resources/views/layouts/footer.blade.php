<footer>
  <nav class="uk-navbar-container" uk-navbar>
    <div class="uk-navbar-left">
      <div class="uk-navbar-item uk-logo">{{ config('app.name') }}</div>

      <ul class="uk-navbar-nav">
        <li><a href="{{ route('index') }}">ホーム</a></li>
        <li><a href="{{ route('browselist') }}">ブラウズリスト</a></li>
        <li><a href="{{ route('privacy') }}">プライバシーポリシー</a></li>
      </ul>
    </div>
    <div class="uk-navbar-right">
      <ul class="uk-navbar-nav">
        <li>
          <a href="#" uk-totop uk-scroll></a>
        </li>
      </ul>
    </div>
  </nav>
</footer>
