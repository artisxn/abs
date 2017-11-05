@extends('layouts.master')

@section('title', 'インポート | ')

@section('content')

  <h1 class="uk-heading-divider">インポート</h1>

  @foreach ($errors->all() as $message)
    <div class="uk-alert-danger" uk-alert>
      <p>{{ $message }}</p>
    </div>
  @endforeach

  @feature('csv_import')

  @can('csv-import')

    <div class="uk-alert-primary" uk-alert>
      <p><span uk-icon="icon: info"></span>
        CSVからインポートしてウォッチリスト(ASIN)に追加します。1列目にASIN/JAN(EAN)コードが並んだCSVに対応。</p>
    </div>

    <div class="uk-grid-divider" uk-grid>
      <div class="uk-width-1-2@m">
        @include('import.jan_form')
      </div>

      <div class="uk-width-1-2@m">
        @include('import.asin_form')
      </div>
    </div>

  @endcan

  @endfeature

@endsection
