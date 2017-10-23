@extends('layouts.master')

@section('content')

  @include('home.form')

  @feature('about')
  @include('home.about')
  @endfeature

  @include('home.price_alert')

  @include('home.pickup')

  @feature('random_browse')
  @include('home.random')
  @endfeature

  @feature('recent_item')
  @include('home.recent')
  @endfeature

@endsection
