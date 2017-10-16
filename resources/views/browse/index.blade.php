@extends('layouts.master')


@section('title', 'ブラウズ：' . $browse_name . ' | ')

@section('content')

  @include('home.form')

  @include('browse.browse-watch')


  <h1 class="uk-heading-divider">ブラウズ{{ $browse_new or '' }}：{{ $browse_name or '' }}</h1>

  @include('browse.new-nav')


  @if(count($browse_items) > 0)
    @foreach($browse_items as $item)
      @include('browse.item')
    @endforeach
  @else
    <div class="uk-alert-warning" uk-alert>
      <p>見つかりませんでした。しばらくしてからもう一度検索してください。(<a href="{{ route('browse', ['browse' => $browse_id]) }}">{{ $browse_id }}</a>)
      </p>
    </div>
  @endif

@endsection
