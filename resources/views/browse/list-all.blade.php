@extends('layouts.master')

@section('title', 'ブラウズリスト（すべて） | ')

@section('content')

  @include('home.form')

  <h1 class="uk-heading-divider">ブラウズリスト（すべて）</h1>

  <p>自動で保存したカテゴリーなので閲覧注意。古いIDは消えてることがあります。</p>

  @if($lists->count() > 0)
    {{ $lists->links() }}

    <ul class="uk-list uk-list-striped">
      @foreach($lists as $browse)
        <li>
          <a href="{{ route('browse', ['browse' => $browse->id]) }}">
            {{ abs_decode($browse->title) }}
            @if($browse->browse_items_count > 0)
              <span class="uk-badge">{{ $browse->browse_items_count }}</span>
            @endif
          </a>

          {{--（<a href="{{ route('browse-new', ['browse' => $browse->id]) }}">ニューリリース</a>）--}}
          [{{ $browse->id }}]
        </li>
      @endforeach
    </ul>

    {{ $lists->links() }}
  @endif

@endsection
