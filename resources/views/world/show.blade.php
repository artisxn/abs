@extends('layouts.master')

@section('title', 'ワールド / ' . $world_items->first()->asin . ' | ')

@section('content')

  <h1 class="uk-heading-divider">ワールド / {{ $world_items->first()->asin }}</h1>

  <div class="uk-overflow-auto">

    <table class="uk-table uk-table-striped uk-table-hover uk-table-divider uk-table-small">
      <thead>
      <tr class="uk-text-nowrap">
        <th>ASIN/JAN</th>
        <th>国</th>
        <th>カテゴリー</th>
        <th>タイトル</th>
        <th>在庫</th>
        <th>新品価格</th>
        <th>新品出品数</th>
        {{--<th>中古価格</th>--}}
        {{--<th>中古出品数</th>--}}
      </tr>
      </thead>
      <tbody>
      @foreach($world_items->groupBy('asin') as $world_asins)

        @foreach($world_asins->sortByDesc('country') as $world_item)
          @include('world.item')
        @endforeach

      @endforeach

      </tbody>
    </table>
  </div>


@endsection
