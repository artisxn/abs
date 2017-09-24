@extends('layouts.master')

@section('title', 'ブラウズリスト')

@section('content')


  <h1 class="uk-heading-divider">ブラウズリスト</h1>

  @if(count($lists) > 0)
    <ul class="uk-list uk-list-striped">
      @foreach($lists as $name => $node)
        <li>
          <a href="{{ route('browse', ['browse' => $node]) }}">{{ $name }}</a> （<a href="{{ route('browse-new', ['browse' => $node]) }}">ニューリリース</a>）[{{ $node }}]
        </li>
      @endforeach
    </ul>
  @endif


@endsection
