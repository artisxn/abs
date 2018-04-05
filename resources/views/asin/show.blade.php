@extends('layouts.master')

@empty($alert_message)

  @php
    $title = de($asin_item->title);
  @endphp

  @section('title', $title . ' | ')
@endempty

@section('content')

  @include('home.form')

  @empty($alert_message)

    @include('item.watchlist')

    <h1 class="uk-heading-divider uk-heading-primary">{{ $title }}</h1>

    @include('asin.item')

    @include('asin.json-ld')

    @else
      <div class="uk-alert-danger" uk-alert>
        <p>見つかりませんでした。しばらく待ってからリロードするか他の商品を検索してください。</p>
      </div>
      @endempty

@endsection
