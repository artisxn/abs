<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>@yield('title') | {{ config('app.name') }}</title>

  <link rel="stylesheet" href="{{ asset('css/material.min.css') }}">
  <link rel="stylesheet" href="//fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">

  <link rel="stylesheet" href="{{ mix('css/app.css') }}">

  @include('layouts.analytics')

</head>
<body>

<div class="mdl-layout mdl-js-layout">

  @include('layouts.header')

  <main class="mdl-layout__content">
    <div class="mdl-grid">

      @include('home.form')

      @yield('content')

    </div>

    @include('layouts.footer')

  </main>


</div>


<script src="{{ asset('/js/material.min.js') }}"></script>


</body>
</html>
