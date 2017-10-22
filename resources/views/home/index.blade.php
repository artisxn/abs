@extends('layouts.master')

@section('content')

  @include('home.form')

  @include('home.about')

  @include('home.price_alert')

  @include('home.pickup')

  @feature('random_browse')
  @include('home.random')
  @endfeature

  @feature('recent_item')
  @include('home.recent')
  @endfeature

@endsection
