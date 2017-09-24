@extends('layouts.master')


@section('title', 'ブラウズ：' . $browse_name . ' | ')

@section('content')

  @include('browse.browse-watch')

  <h1 class="uk-heading-divider">ブラウズ：{{ $browse_name or '' }}</h1>

  @if(count($items) > 0)
    @foreach($items as $item)
      @include('browse.item')
    @endforeach
  @else
    見つかりませんでした。しばらくしてからもう一度検索してください。(<a href="{{ route('browse', ['browse' => $browse]) }}">{{ $browse }}</a>)
  @endif


@endsection
