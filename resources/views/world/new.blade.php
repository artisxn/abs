@extends('layouts.master')

@section('title', 'ワールド（新着） | ')

@section('content')

  @include('world.subnav')

  <h1 class="uk-heading-divider">ワールド（新着）</h1>

  {{ $world_items->links() }}

  <div class="uk-overflow-auto">

    <table class="uk-table uk-table-striped uk-table-hover uk-table-divider uk-table-small uk-text-small">

      @include('world.thead')

      <tbody>
      @foreach($world_items as $world_item)
        @include('world.item')
      @endforeach
      </tbody>
    </table>
  </div>

  {{ $world_items->links() }}

@endsection
