@extends('layouts.master')


@section('content')

  <div class="uk-section uk-section-muted uk-padding-large uk-margin-bottom">
    <div class="uk-container">

      <h2 class="uk-heading-divider">非公開設定で運営中です</h2>

      <p>表示するには<a href="{{ route('login') }}">ログイン</a>してください。</p>

      <p>ゲストログイン機能が有効な場合は専用のURLからログインできます。</p>

    </div>
  </div>

@endsection
