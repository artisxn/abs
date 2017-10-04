@extends('layouts.master')

@section('title', '特集ページ：ゲーム' . ' | ')

@section('content')

  <h1 class="uk-heading-divider uk-heading-primary">特集ページ：ゲーム</h1>

  <div class="uk-section uk-section-primary uk-light uk-padding">
    <div class="uk-container">
      <h3>取得済み件数 <strong>{{ $items->total() }}</strong>（目標：3万）</h3>
    </div>
  </div>

  <h3 class="uk-heading-line"><span>取得済タイトルリスト</span></h3>

  <div class="uk-alert-danger" uk-alert>
    <p>
      なるべく重複しないようにしてください
    </p>
  </div>

  {{ $items->links() }}

  <div class="uk-overflow-auto">

    <table class="uk-table uk-list-striped uk-table-hover uk-table-divider uk-table-small">
      <thead>
      <tr>
        <th>ASIN</th>
        <th>タイトル</th>
        <th>機種</th>
      </tr>
      </thead>
      <tbody>
      @foreach($items as $item)
        <tr>
          <td>{{ $item->asin }}</td>
          <td><a href="{{ route('asin', $item->asin) }}">{{ str_limit($item->title, 80) }}</a></td>
          <td>
            @if(count($item->browses) >= 4)
              {{ $item->browses[1]->title or '' }}
            @else
              {{ $item->browses[0]->title or '' }}
            @endif
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>

  {{ $items->links() }}

@endsection
