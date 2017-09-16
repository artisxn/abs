<footer>
  <nav class="uk-navbar-container" uk-navbar>
    <div class="uk-navbar-left">
      <div class="uk-navbar-item uk-logo">{{ config('app.name') }}</div>

      <ul class="uk-navbar-nav">
        <li><a href="{{ route('index') }}">ホーム</a></li>
        <li><a href="{{ route('browselist') }}">ブラウズリスト</a></li>
      </ul>
    </div>
  </nav>
</footer>
