@extends('layouts.master')

@section('title', 'ブラウズリスト')

@section('content')


  <h1 class="uk-heading-divider">ブラウズリスト</h1>

  @if($lists->count() > 0)
    <ul class="uk-list uk-list-striped">
      @foreach($lists as $browse)
        <li>
          <a href="{{ route('browse', ['browse' => $browse->id]) }}">{{ $browse->title }}</a> （<a href="{{ route('browse-new', ['browse' => $browse->id]) }}">ニューリリース</a>）[{{ $browse->id }}]
        </li>
      @endforeach
    </ul>
  @endif


@endsection
