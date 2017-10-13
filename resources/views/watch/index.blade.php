@extends('layouts.master')

@section('title', 'ウォッチリスト | ')


@section('content')

  @include('home.form')

  <h1 class="uk-heading-divider">ウォッチリスト</h1>

  <div class="uk-alert-primary" uk-alert>
    <p>CSVには当サイト内で保存済みのデータのみ含まれます。{{ config('amazon.csv_limit') }}件分まで。</p>
  </div>

  <div class="uk-grid-divider" uk-grid>
    <div class="uk-width-1-2@m">
      @include('watch.asin')

      @include('watch.import_form')
    </div>

    <div class="uk-width-1-2@m">
      @include('watch.browse')
    </div>
  </div>

@endsection
