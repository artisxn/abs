@extends('layouts.master')

@section('title', 'ウォッチリスト')

@section('content')

  <h1 class="uk-heading-divider">ウォッチリスト</h1>

  <div class="uk-alert-primary" uk-alert>
    <p>CSVには当サイト内で保存済みのデータのみ含まれます。上手くダウンロードできないカテゴリーもあります。</p>
  </div>

  <div class="uk-alert-danger" uk-alert>
    <p>削除は即実行されます。</p>
  </div>

  <div class="uk-grid-divider" uk-grid>
    <div class="uk-width-1-2@m">
      @include('watch.asin')
    </div>
    <div class="uk-width-1-2@m">
      @include('watch.browse')

    </div>
  </div>

@endsection
