@extends('layouts.master')

@section('title', '使い方' . ' | ')


@section('content')


  <h2 class="uk-heading-divider">使い方</h2>

  （未完成版）

  <h3>Amazonアカウントでログイン</h3>

  <p>Login with Amazonを使ってAmazonアカウントでログインしてユーザー登録できます。よくあるTwitterでログインと同じです。ユーザー登録に使うだけなのでAmazon側になにか影響することはありません。</p>

  <h3>ウォッチリスト</h3>

  <p>ASINやカテゴリーを指定してウォッチリストに追加できます。今後ASINやカテゴリーごとに商品情報をCSVでダウンロード可能になる予定。</p>

  <h3>カテゴリーをウォッチリストに追加</h3>

  <p><a href="{{ route('browselist') }}">ブラウズリスト</a>にあるカテゴリーはそのまま表示して追加できますがリストにないカテゴリーも追加できます。</p>

  <p>例：Amazonで本カテゴリーのURL https://www.amazon.co.jp/%E6%9C%AC-%E9%80%9A%E8%B2%A9/b/?ie=UTF8&node=465392
    これの<code>node=</code>の後ろがIDになるので https://abs.kawax.biz/browse/ にIDを付けて https://abs.kawax.biz/browse/465392
    で表示するとウォッチリストに追加できます。
  </p>

  <p>ID指定しても表示できないカテゴリーもあります。</p>

  <h3>無料で使えますか？</h3>

  <p>現時点では無料で使えます。ただし莫大な量のデータを保存するサービスに変わったので一部機能をオプションとして有料化の可能性はあります。</p>

  <ul class="uk-list uk-list-bullet">
    <li>ASINカウント : {{ $items_count or '0' }}</li>
    <li>履歴カウント : {{ $histories_count or '0' }}</li>
    <li>カテゴリーカウント : {{ $browses_count or '0' }}</li>
  </ul>

@endsection
