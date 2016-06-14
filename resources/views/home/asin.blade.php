@extends('layouts.master')

@php
$title = array_get($item, 'ItemAttributes.Title');
@endphp

@section('title', $title)

@section('content')

  <div class="mdl-cell mdl-cell--12-col">

    <h1>{{ $title }}</h1>

    @include('home.item')

  </div>


@endsection
