@extends('layouts.master')

@section('title', '設定' . ' | ')

@section('content')
  <h2 class="uk-heading-divider"><span>設定</span></h2>

  @foreach ($errors->all() as $message)
    <div class="uk-alert-danger" uk-alert>
      <p>{{ $message }}</p>
    </div>
  @endforeach


  <div class="uk-section  uk-padding">

    <form action="{{ route('settings.store') }}" method="post" class="uk-form-horizontal">
      {{ csrf_field() }}

      @feature('plan')
      <div class="uk-margin">
        <label class="uk-form-label">プラン</label>

        <div class="uk-form-controls">
          {{ title_case(request()->user()->plan()) }}
        </div>
      </div>

      <div class="uk-margin">
        <label class="uk-form-label">特典キー</label>

        <div class="uk-form-controls">
          <input name="special_key" value="{{ request()->user()->special_key }}" class="uk-input" type="text"
                 placeholder="特典キー">
          <small class="uk-text-muted">
            <a href="https://enty.jp/kawax" target="_blank">Enty</a>
            /
            <a href="https://fantia.jp/kawax" target="_blank">fantia</a>
            の支援特典。キーは不定期に変更されます。
          </small>
        </div>
      </div>
      @endfeature

      @feature('notify_mail')
      <div class="uk-margin">
        <label class="uk-form-label">メールで通知</label>

        <div class="uk-form-controls">
          <label>
            {{ Form::checkbox('notify_mail', 1, request()->user()->notify_mail, ['class' => 'uk-checkbox']) }}
          </label>
          <small class="uk-text-muted">送信先はAmazonアカウントのメールアドレス。パーソナルプラン以上のみ対応。</small>
        </div>
      </div>
      @endfeature

      @feature('api')
      <div class="uk-margin">
        <label class="uk-form-label">APIトークン</label>

        <div class="uk-form-controls">
          <input name="api_token"
                 value="{{ empty(request()->user()->api_token) ? str_random(60) : request()->user()->api_token }}"
                 class="uk-input" type="text"
                 placeholder="APIトークン">
          <small class="uk-text-muted"></small>
        </div>
      </div>
      @endfeature


      <div class="uk-margin">
        <label class="uk-form-label"></label>

        <div class="uk-form-controls">
          <button class="uk-button uk-button-primary">保存</button>
        </div>
      </div>
    </form>
  </div>
@endsection
