@extends('layouts.master')

@section('title', 'ウォッチリスト | ')

@section('content')

  <h1 class="uk-heading-divider">ウォッチリスト</h1>

  <div class="uk-alert-primary" uk-alert>
    <p>CSVには当サイト内で保存済みのデータのみ含まれます。{{ config('amazon.csv_limit') }}件分まで。</p>
  </div>

  @unless(empty($watch_delete))
    <div class="uk-alert-danger" uk-alert>
      <p>削除は即実行されます。</p>
    </div>
  @endunless

  <div class="uk-grid-divider" uk-grid>
    <div class="uk-width-1-2@m">
      @include('watch.asin')
    </div>
    <div class="uk-width-1-2@m">
      @include('watch.browse')

    </div>
  </div>

  @if(empty($watch_delete))
    <div class="uk-alert-danger" uk-alert>
      <p><a href="{{ route('watch', ['mode' => 'delete']) }}">削除モード</a></p>
    </div>
  @endif

@endsection
