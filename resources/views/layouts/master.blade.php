<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>@yield('title') | {{ config('app.name') }}</title>

  <link rel="stylesheet" href="{{ mix('css/app.css') }}">

  @include('layouts.analytics')

</head>
<body>


@include('layouts.header')

<main class="uk-container">

  @include('home.form')

  @yield('content')


</main>

@include('layouts.footer')


<script src="{{ mix('/js/app.js') }}"></script>

<!-- {{ app()->version() }} -->

</body>
</html>
