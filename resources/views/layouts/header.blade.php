<header class="mdl-layout__header mdl-layout--no-drawer-button">

  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">{{ config('app.name') }}</span>
    <div class="mdl-layout-spacer"></div>
    <nav class="mdl-navigation">
      <a class="mdl-navigation__link" href="{{ action('AmazonController@index') }}">ホーム</a>

      <a class="mdl-navigation__link" href="{{ action('AmazonController@browseList') }}">ブラウズリスト</a>
    </nav>
  </div>
</header>
