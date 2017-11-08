@extends('layouts.master')

@section('title', '特集：本 | ')

@section('content')

  <div class="uk-alert-primary" uk-alert>
    <p>「特定のカテゴリーのこういう情報が欲しい」という依頼が多いのでサンプルとしていくつか作る。</p>
  </div>

  <h1 class="uk-heading-divider">特集：本</h1>

  <div class="uk-grid-divider" uk-grid>
    <div class="uk-width-1-2@m">
      @include('feature.best_seller')
    </div>

    <div class="uk-width-1-2@m">
      @include('feature.pre_order')
    </div>
  </div>
@endsection
