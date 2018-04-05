@extends('layouts.master')

@section('title', de($keyword) . ' | ')

@section('content')

  @include('home.form')

  <h1 class="uk-heading-divider">{{ de($keyword) }} ({{ $TotalResults ?? 0 }} 件)</h1>

  @if(count($items) > 0)
    @foreach($items as $item)
      @include('browse.item')
    @endforeach

    @if($TotalPages > $page)
      <a href="{{ route('search', [
                'category' => $category,
                'keyword' => de($keyword),
                'page' => $page + 1
        ]) }}"
         class="uk-button uk-button-danger uk-button-large uk-width-1-1 uk-margin-large-bottom">
        <span uk-icon="icon: arrow-right"></span>
        次のページ
      </a>

    @endif

  @else
    <div class="uk-alert-warning" uk-alert>
      <p>見つかりませんでした。しばらくしてからもう一度検索してください。
      </p>
    </div>

    @if($page >= 5 and !empty(session('MoreSearchResultsUrl')))
      <div class="uk-alert-danger" uk-alert>
        <p>
          一定ページ数以上は表示できないので続きはAmazonで検索してください。(現在のページ：{{ $page }})
        </p>
      </div>

      <p>
        <a href="{{ session('MoreSearchResultsUrl') }}"
           class="uk-button uk-button-danger uk-button-large uk-width-1-1 uk-margin-large-bottom">Amazonで検索</a>
      </p>
    @endif

  @endif

@endsection
