@extends('layouts.master')

@section('title', 'JANインポート | ')

@section('content')

  <h1 class="uk-heading-divider">JANインポート</h1>

  <div class="uk-alert-primary" uk-alert>
    <p>JANリスト({{ $jan_count }}件)のインポートを開始しました。完了までは時間がかかるのでしばらく待ちください。およそ {{ ceil($jan_count/20) }} 分。</p>
  </div>

@endsection
