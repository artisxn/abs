
<footer>
  <nav class="uk-navbar-container" uk-navbar>
    <div class="uk-navbar-left">{{ config('app.name') }}</div>
    <div class="uk-navbar-left">
      <ul class="uk-navbar-nav">
        <li><a href="{{ route('index') }}">ホーム</a></li>
        <li><a href="{{ route('browselist') }}">ブラウズリスト</a></li>
      </ul>
    </div>
  </nav>
</footer>
