@extends('layouts.master')

@php
  $title = array_get($item, 'ItemAttributes.Title') . ' | ';
@endphp

@section('title', $title)

@section('content')


  <h1 class="uk-heading-divider">{{ $title }}</h1>

  @include('item.item')



@endsection
