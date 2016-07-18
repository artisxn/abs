<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>@yield('title') | Amazon Search</title>

  <link rel="stylesheet" href="{{ asset('css/material.min.css') }}">
  <link rel="stylesheet" href="//fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">

  <link rel="stylesheet" href="{{ elixir('css/app.css') }}">

  @include('layouts.analytics')

</head>
<body>

<div class="mdl-layout mdl-js-layout">
  <header class="mdl-layout__header mdl-layout--no-drawer-button">

    <div class="mdl-layout__header-row">
      <span class="mdl-layout-title">Amazon Search</span>
      <div class="mdl-layout-spacer"></div>
      <nav class="mdl-navigation">
        <a class="mdl-navigation__link" href="{{ action('AmazonController@index') }}">ホーム</a>

        <a class="mdl-navigation__link" href="{{ action('AmazonController@browseList') }}">ブラウズリスト</a>
      </nav>
    </div>
  </header>


  <main class="mdl-layout__content">
    <div class="mdl-grid">

      @include('home.form')

      @yield('content')

    </div>

  </main>
</div>


<script src="{{ asset('/js/material.min.js') }}"></script>

<script type="text/javascript">
  amzn_assoc_ad_type = "link_enhancement_widget";
  amzn_assoc_tracking_id = "{{ config('amazon.associate_tag') }}";
  amzn_assoc_placement = "";
  amzn_assoc_marketplace = "amazon";
  amzn_assoc_region = "JP";
</script>
<script src="//z-fe.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&Operation=GetScript&ID=OneJS&WS=1&MarketPlace=JP"></script>

</body>
</html>
