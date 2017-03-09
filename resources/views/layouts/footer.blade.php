
<footer class="mdl-mini-footer">
  <div class="mdl-mini-footer__left-section">
    <div class="mdl-logo">{{ config('app.name') }}</div>
    <ul class="mdl-mini-footer__link-list">
      <li><a href="{{ action('AmazonController@index') }}">ホーム</a></li>
      <li><a href="{{ action('AmazonController@browseList') }}">ブラウズリスト</a></li>
    </ul>
  </div>
</footer>
