@extends('layouts.master')

@section('title', 'ASINウォッチリスト | ')

@section('content')

  @include('home.form')

  <h1 class="uk-heading-divider">ASINウォッチリスト</h1>

  <div class="uk-grid-divider" uk-grid>
    <div class="uk-width-1-1">
      @include('watch.asin')
    </div>
  </div>

@endsection
