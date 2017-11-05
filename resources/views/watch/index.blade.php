@extends('layouts.master')

@section('title', 'ウォッチリスト | ')


@section('content')

  @include('home.form')

  <h1 class="uk-heading-divider">ウォッチリスト</h1>

  @feature('csv_download')
  <div class="uk-alert-primary" uk-alert>
    <p>CSVには当サイト内で保存済みのデータのみ含まれます。{{ auth()->user()->csvLimit() }}件分まで。件数指定のダウンロードは
      <a href="{{ route('export.index') }}">エクスポート</a>から。</p>
  </div>
  @endfeature


  <div class="uk-grid-divider" uk-grid>
    <div class="uk-width-1-2@m">
      @include('watch.asin')
    </div>

    <div class="uk-width-1-2@m">
      @include('watch.browse')
    </div>
  </div>

@endsection
