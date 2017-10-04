@extends('layouts.master')

@section('title', 'タスク' . ' | ')

@section('content')

  後で消すページ。

  <h3 class="uk-heading-line"><span>タスクユーザー</span></h3>

  <table class="uk-table uk-table-striped uk-table-hover uk-table-divider uk-table-small">
    <thead>
    <tr>
      <th>メール</th>
      <th>カウント</th>
      <th>[作成日時]（親カテゴリー。637394ならゲーム）ウォッチリスト</th>
      <th>登録日</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
      <tr>
        <td>{{ str_limit($user->email, 5) }}</td>
        <td>{{ $user->watches->count() }}</td>
        <td>
          <select class="uk-select">
            @foreach($user->watches as $watch)
              <option>
                [{{ $watch->item->created_at }}]
                ({{ $watch->item->browses->last()->id or '' }})
                {{ str_limit($watch->item->title, 5) }}
              </option>
            @endforeach
          </select>
        </td>
        <td>{{ $user->created_at }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>

@endsection
