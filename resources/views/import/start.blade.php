@extends('layouts.master')

@section('title', 'インポート開始 | ')

@section('content')

  <h1 class="uk-heading-divider">インポート</h1>

  <div class="uk-alert-primary" uk-alert>
    <p>{{ $csv_count }}件のインポートを開始しました。完了までは時間がかかるのでしばらく待ちください。およそ {{ ceil($csv_count/20) }} 分。</p>
  </div>

@endsection
