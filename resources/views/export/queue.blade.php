@extends('layouts.master')

@section('title', 'エクスポート' . ' | ')

@section('content')

  <div class="uk-alert-primary" uk-alert>
    <h4>しばらくお待ち下さい</h4>
    <p>CSVの準備が完了したら<a href="{{ route('notifications') }}">通知ページ</a>からダウンロードできるようになります。</p>
  </div>

@endsection
