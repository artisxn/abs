@extends('layouts.master')

@section('title', 'ワールド | ')

@section('content')

  @include('world.subnav')

  <h1 class="uk-heading-divider">ワールド（{{ $world_items->total() }}）</h1>

  @include('world.search')

  {{ $world_items->appends(['search' => request()->input('search')])->links() }}

  <div class="uk-overflow-auto">

    <table class="uk-table uk-table-striped uk-table-hover uk-table-divider uk-table-small uk-text-small">

      @include('world.thead')

      <tbody>
      @foreach($world_items->groupBy('asin') as $world_asins)

        @foreach($world_asins->sortByDesc('country') as $world_item)
          @include('world.item')
        @endforeach

      @endforeach

      </tbody>
    </table>
  </div>

  {{ $world_items->appends(['search' => request()->input('search')])->links() }}

@endsection
