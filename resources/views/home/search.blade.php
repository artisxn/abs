@extends('layouts.master')

@section('title', $keyword)

@section('content')

  <div class="mdl-cell mdl-cell--12-col">

    <h1>{{ $keyword }} ({{ $TotalResults or 0 }} 件)</h1>

    @if(count($items) > 0)
      @foreach($items as $item)
        @include('home.item')
      @endforeach

      @if($TotalPages > $page)
        <a href="{{ action('AmazonController@search', [
                'category' => $category,
                'keyword' => $keyword,
                'page' => $page + 1
        ]) }}"
           class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
          <i class="material-icons">arrow_forward</i>
        </a>
      @endif

    @else
      見つかりませんでした。もう一度検索してください。
    @endif
  </div>


@endsection
