@extends('layouts.master')

@section('content')


  @include('home.about')

  <h4 class="uk-heading-divider">ブラウズ：{{ $browse_name or '' }}</h4>

  @if(count($items) > 0)
    @foreach($items as $item)
      @include('browse.item')
    @endforeach
  @else
    見つかりませんでした。もう一度検索してください。(<a href="{{ route('browse', ['browse' => $browse]) }}">{{ $browse }}</a>)
  @endif


@endsection
