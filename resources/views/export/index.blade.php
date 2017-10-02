@extends('layouts.master')

@section('title', 'エクスポート' . ' | ')

@section('content')
  <h2 class="uk-heading-line uk-text-center"><span>エクスポート</span></h2>

  @foreach ($errors->all() as $message)
    <div class="uk-alert-danger" uk-alert>
      <p>{{ $message }}</p>
    </div>
  @endforeach


  <div class="uk-section uk-section-secondary uk-dark uk-width-3-4 uk-align-center uk-padding">

    <form action="{{ route('export.export') }}" method="post" class="uk-form-horizontal">
      {{ csrf_field() }}

      <div class="uk-margin">
        <label class="uk-form-label">カテゴリー</label>

        <div class="uk-form-controls">
          <input name="category" value="{{ old('category') }}" class="uk-input" type="number" placeholder="カテゴリーID">
        </div>
      </div>

      <div class="uk-margin">
        <label class="uk-form-label">件数</label>

        <div class="uk-form-controls">
          <input name="limit" value="{{ old('limit', 1000) }}" class="uk-input" type="number" placeholder="件数">
        </div>
      </div>

      <div class="uk-margin">
        <label class="uk-form-label">並べ替え</label>

        <div class="uk-form-controls">
          <select name="order" class="uk-select uk-width-1-3">
            <option value="updated_at" selected>更新時間</option>
            <option value="rank">ランキング</option>
          </select>

          <select name="sort" class="uk-select uk-width-1-3">
            <option value="desc" selected>降順</option>
            <option value="asc">昇順</option>
          </select>
        </div>
      </div>

      <div class="uk-margin">
        <label class="uk-form-label"></label>

        <div class="uk-form-controls">
          <button class="uk-button uk-button-primary">エクスポート</button>
        </div>
      </div>
    </form>
  </div>
@endsection
