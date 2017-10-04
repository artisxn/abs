@extends('layouts.master')

@section('title', '特集ページ：ゲーム' . ' | ')

@section('content')

  <h1 class="uk-heading-divider">特集ページ：ゲーム</h1>

  <div class="uk-section uk-section-primary uk-light uk-padding">
    <div class="uk-container">
      <h3>取得済み件数 <strong>{{ $items->total() }}</strong>（目標：3万）</h3>
    </div>
  </div>

  <h3 class="uk-heading-line"><span>作業内容</span></h3>

  <ol>
    <li><a href="{{ route('login') }}">Amazonアカウントでログイン</a>してユーザー登録</li>
    <li>TVゲームカテゴリーからゲーム名で検索して個別ページ(URLが/asin/...)を表示してASINウォッチリストに追加</li>
    <li>指定の件数追加したら上の取得済み件数が増えてることを確認して完了報告。</li>
    <li>下の取得済リストは新しい順なので重複しなければ自分が追加したタイトルが出てくるのでそれでも確認できます。重複が多いまたはカテゴリー違いの場合は却下されます。</li>
  </ol>

  <p>目的は個別ページを表示して最新データを取得することなので登録したユーザーデータなどは後で消える可能性があります。ウォッチリストへの追加は作業した証拠です。</p>

  <h3 class="uk-heading-line"><span>取得済タイトルリスト</span></h3>

  <div class="uk-alert-danger" uk-alert>
    <p>
      なるべく重複しないようにしてください
    </p>
  </div>

  {{ $items->links() }}

  <div class="uk-overflow-auto">

    <table class="uk-table uk-table-striped uk-table-hover uk-table-divider uk-table-small">
      <thead>
      <tr>
        <th>ASIN</th>
        <th>タイトル</th>
        <th>機種</th>
      </tr>
      </thead>
      <tbody>
      @foreach($items as $item)
        <tr>
          <td>{{ $item->asin }}</td>
          <td><a href="{{ route('asin', $item->asin) }}">{{ str_limit($item->title, 80) }}</a></td>
          <td>
            {{ $item->browses[count($item->browses) - 3]->title or '' }}
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>

  {{ $items->links() }}

@endsection
