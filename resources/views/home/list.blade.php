@extends('layouts.master')

@section('title', 'ブラウズリスト')

@section('content')

  <div class="mdl-cell mdl-cell--12-col">

    <h1>ブラウズリスト</h1>

    @if(count($lists) > 0)
      <ul>
        @foreach($lists as $name => $node)
          <li>
            <a href="{{ action('AmazonController@browse', ['node' => $node]) }}">{{ $name }}</a>
          </li>
        @endforeach
      </ul>
    @endif
  </div>


@endsection
