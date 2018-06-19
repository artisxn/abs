@extends('layouts.master')

@section('title', '特集：テレビゲーム | ')

@section('content')

    @include('feature.info')

    <h1 class="uk-heading-divider">特集：テレビゲーム</h1>

    <div class="uk-grid-divider" uk-grid>
        {{--<div class="uk-width-1-1">--}}
        {{--@include('feature.best_seller')--}}
        {{--</div>--}}

        @empty($pre_orders)
            <div class="uk-width-1-1">
                <div class="uk-alert-warning uk-margin-top" uk-alert>
                    <p>
                        更新中。
                    </p>
                </div>
            </div>
        @else
            <div class="uk-width-1-1">
                @include('feature.pre_order')
            </div>
        @endempty
    </div>

@endsection
