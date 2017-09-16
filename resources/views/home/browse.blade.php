@extends('layouts.master')


@section('title', 'ブラウズ：' . $browse_name)

@section('content')


  <h1 class="uk-heading-divider">ブラウズ：{{ $browse_name or '' }}</h1>

  @if(count($items) > 0)
    @foreach($items as $item)
      @include('item.item')
    @endforeach
  @else
    見つかりませんでした。もう一度検索してください。(<a href="{{ route('browse', ['browse' => $browse]) }}">{{ $browse }}</a>)
  @endif


@endsection
