@extends('layouts.master')

@section('title', 'ブラウズリスト（すべて）')

@section('content')


  <h1 class="uk-heading-divider">ブラウズリスト（すべて）</h1>

  <p>自動で保存したカテゴリーなので閲覧注意。古いIDは消えてることがあります。</p>

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
