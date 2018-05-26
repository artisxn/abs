<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('layouts.analytics')

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="vapidPublicKey" content="{{ config('webpush.vapid.public_key') }}">

    <title>@yield('title'){{ config('app.name') }}</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <link rel='icon' type='image/png' href='/icon.png'>
    <link rel="apple-touch-icon" sizes="144x144" href="/icon.png">
    <link rel="apple-touch-icon" sizes="192x192" href="/icon-192x192.png">

    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#1e87f0"/>

    @include('layouts.analytics_verification')

    @feature('adsense')
    {{--@include('layouts.adsense_header')--}}
    @endfeature

    @include('layouts.preload')

    <meta name="author" content="kawax">
</head>
<body>
<div id="app" class="uk-offcanvas-content">

    @include('layouts.header')

    <main class="uk-container">

        @yield('content')

    </main>

    @include('layouts.footer')

</div>

<script src="{{ mix('/js/manifest.js') }}"></script>
<script src="{{ mix('/js/vendor.js') }}"></script>
<script src="{{ mix('/js/app.js') }}"></script>

<!-- {{ app()->version() }} -->

</body>
</html>
