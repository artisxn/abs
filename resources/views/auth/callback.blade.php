@extends('layouts.master')

@section('title', 'ログイン成功' . ' | ')

@section('content')

  <div class="uk-alert-primary" uk-alert>
    <h4>ログイン成功</h4>
    <p><a href="{{ route('watch') }}">ウォッチリストへ</a></p>
  </div>

@endsection
