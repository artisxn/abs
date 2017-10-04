@extends('layouts.master')

@section('title', 'タスク' . ' | ')

@section('content')

  <h1 class="uk-heading-divider uk-heading-primary">タスク</h1>

  <h3 class="uk-heading-line"><span>タスクユーザー</span></h3>

  <div class="uk-overflow-auto">

    <table class="uk-table uk-list-striped uk-table-hover uk-table-divider uk-table-small">
      <thead>
      <tr>
        <th>メール</th>
        <th>カウント</th>
        <th>登録日</th>
      </tr>
      </thead>
      <tbody>
      @foreach($users as $user)
        <tr>
          <td>{{ str_limit($user->email, 5) }}</td>
          <td>{{ $user->watches_count }}</td>
          <td>{{ $user->created_at }}</td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>

@endsection
