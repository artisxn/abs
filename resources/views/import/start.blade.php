@extends('layouts.master')

@section('title', 'インポート開始 | ')

@section('content')

  <h1 class="uk-heading-divider">インポート</h1>

  <div class="uk-alert-primary" uk-alert>
    <p>
      @isset($csv_count)
        {{ $csv_count }}件の
      @endisset
      インポートを開始しました。完了までは時間がかかるのでしばらく待ちください。
      @isset($csv_count)
        およそ {{ ceil($csv_count/20) }} 分。
      @endisset
    </p>
  </div>

@endsection
