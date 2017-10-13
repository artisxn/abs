@extends('layouts.master')

@section('title', 'ワールド | ')

@section('content')

  <h1 class="uk-heading-divider">ワールド</h1>

  {{ $world_items->links() }}

  <div class="uk-overflow-auto">

    <table class="uk-table uk-table-striped uk-table-hover uk-table-divider uk-table-small">
      <thead>
      <tr class="uk-text-nowrap">
        <th>ASIN</th>
        <th>国</th>
        <th>タイトル</th>
        <th>在庫</th>
        <th>新品価格</th>
        <th>新品出品数</th>
        <th>中古価格</th>
        <th>中古出品数</th>
      </tr>
      </thead>
      <tbody>
      @foreach($world_items as $world_item)
        <tr>
          <td><a href="{{ route('asin', $world_item->asin) }}">{{ $world_item->asin }}</a></td>
          <td>{{ $world_item->country }}</td>
          <td>{{ $world_item->title }}</td>
          <td>{{ $world_item->availability }}</td>
          <td>{{ $world_item->priceFormat($world_item->lowest_new_price) }}</td>
          <td>{{ $world_item->total_new }}</td>
          <td>{{ $world_item->priceFormat($world_item->lowest_used_price) }}</td>
          <td>{{ $world_item->total_used }}</td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>

  {{ $world_items->links() }}

@endsection
