@extends('layouts.master')

@section('title', $keyword)

@section('content')


  <h1 class="uk-heading-divider">{{ $keyword }} ({{ $TotalResults or 0 }} 件)</h1>

  @if(count($items) > 0)
    @foreach($items as $item)
      @include('home.item')
    @endforeach

    @if($TotalPages > $page)
      <a href="{{ route('search', [
                'category' => $category,
                'keyword' => $keyword,
                'page' => $page + 1
        ]) }}"
         class="uk-button uk-button-danger uk-button-large uk-width-1-1 uk-margin-large-bottom">
        <span uk-icon="icon: arrow-right"></span>
        次のページ
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
           class="uk-button uk-button-primary uk-button-large uk-width-1-1 uk-margin-large-bottom">Amazonで検索</a>
      </p>
    @endif

  @endif


@endsection
