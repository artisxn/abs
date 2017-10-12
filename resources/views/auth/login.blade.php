@extends('layouts.master')

@section('content')
  <div class="uk-container">
    <div class="uk-card uk-card-default uk-margin-top">
      <div class="uk-card-header">
        <h3 class="uk-card-title">デバッグ用パスワードログイン</h3>
      </div>

      <div class="uk-card-body">
        <form class="uk-form-horizontal" role="form" method="POST" action="{{ route('auth.login.post') }}">
          {{ csrf_field() }}

          <div class="uk-margin">
            <label for="id" class="uk-form-label">ユーザーID</label>

            <div class="uk-form-controls">
              <input id="id" type="number" name="id" value="{{ old('id') or '1' }}" class="uk-input uk-form-width-large{{ $errors->has('id') ? ' uk-form-danger' : '' }}">

              @if($errors->has('id'))
                <div class="uk-form-help-block uk-text-danger">
                  <strong>{{ $errors->first('id') }}</strong>
                </div>
              @endif
            </div>
          </div>

          <div class="uk-margin">
            <label for="password" class="uk-form-label">パスワード</label>

            <div class="uk-form-controls">
              <input id="password" type="password" name="password"
                     class="uk-input uk-form-width-large{{ $errors->has('password') ? ' uk-form-danger' : '' }}">

              @if ($errors->has('password'))
                <div class="uk-form-help-block uk-text-danger">
                  <strong>{{ $errors->first('password') }}</strong>
                </div>
              @endif
            </div>
          </div>

          <div class="uk-margin">
            <div class="uk-form-controls">
              <button type="submit" class="uk-button uk-button-primary">
                ログイン
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection
