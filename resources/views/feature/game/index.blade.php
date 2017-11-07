@extends('layouts.master')

@section('title', '特集：テレビゲーム | ')


@section('content')

  <div class="uk-alert-primary" uk-alert>
    <p>「特定のカテゴリーのこの情報が欲しい」という依頼が多いのでサンプルとしていくつか作る。</p>
  </div>

  <h1 class="uk-heading-divider">特集：テレビゲーム</h1>

  @feature('feature_game')

  <div class="uk-grid-divider" uk-grid>
    <div class="uk-width-1-2@m">
      @include('feature.game.best_seller')
    </div>

    <div class="uk-width-1-2@m">
      @include('feature.game.pre_order')
    </div>
  </div>

  @endfeature

@endsection
