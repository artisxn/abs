@extends('layouts.master')


@section('title', 'ブラウズ：' . $browse_name . ' | ')

@section('content')

  @include('browse.browse-watch')

  <h1 class="uk-heading-divider">ブラウズ：{{ $browse_name or '' }}</h1>

  @if(count($browse_items) > 0)
    @foreach($browse_items as $item)
      @include('browse.item')
    @endforeach
  @else
    <div class="uk-alert-warning" uk-alert>
      <a class="uk-alert-close" uk-close></a>
      <p>見つかりませんでした。しばらくしてからもう一度検索してください。(<a href="{{ route('browse', ['browse' => $browse_id]) }}">{{ $browse_id }}</a>)
      </p>
    </div>
  @endif

@endsection
