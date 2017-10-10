@extends('layouts.master')

@section('content')

  @include('home.about')

  @include('home.pickup')

  @feature('random_browse')
  @include('home.random')
  @endfeature

  @feature('recent_item')
  @include('home.recent')
  @endfeature

@endsection
