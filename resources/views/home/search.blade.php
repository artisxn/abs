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
      <p>見つかりませんでした。もう一度検索してください。</p>

      @if($page >= 5 and !empty(session('MoreSearchResultsUrl')))
        <p>
          一定ページ数以上は表示できないので続きはAmazonで検索してください。(現在のページ：{{ $page }})
        </p>
        <p>
          <a href="{{ session('MoreSearchResultsUrl') }}"
             class="mdl-button mdl-js-button mdl-button--colored mdl-button--raised">Amazonで検索</a>
        </p>
      @endif

    @endif
  </div>


@endsection
