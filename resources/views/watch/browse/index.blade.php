@extends('layouts.master')

@section('title', 'カテゴリーウォッチリスト | ')

@section('content')

  <h1 class="uk-heading-divider">カテゴリーウォッチリスト</h1>

  <div class="uk-grid-divider" uk-grid>
    <div class="uk-width-1-1">
      @include('watch.browse')
    </div>
  </div>

@endsection
