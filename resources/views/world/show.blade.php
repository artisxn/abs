@extends('layouts.master')

@section('title', 'ワールド / ' . $world_items->first()->asin . ' | ')

@section('content')

  @include('world.subnav')

  <h1 class="uk-heading-divider">ワールド / {{ $world_items->first()->asin }}</h1>

  @include('world.search')

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


@endsection
