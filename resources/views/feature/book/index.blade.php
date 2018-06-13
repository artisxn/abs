@extends('layouts.master')

@section('title', '特集：本 | ')

@section('content')

    @include('feature.info')

    <h1 class="uk-heading-divider">特集：コミック</h1>

    <div class="uk-grid-divider" uk-grid>
        <div class="uk-width-1-1">
            @include('feature.best_seller')
        </div>

        {{--<div class="uk-width-1-1">--}}
        {{--@include('feature.pre_order')--}}
        {{--</div>--}}
    </div>
@endsection
