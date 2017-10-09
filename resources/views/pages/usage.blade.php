@extends('layouts.master')

@section('title', '使い方' . ' | ')


@section('content')


  <h2 class="uk-heading-divider">使い方</h2>

  （未完成版）

  <h3>Amazonアカウントでログイン</h3>

  <p>Login with Amazonを使ってAmazonアカウントでログインしてユーザー登録できます。よくあるTwitterでログインと同じです。ユーザー登録に使うだけなのでAmazon側になにか影響することはありません。</p>

  <h3>ウォッチリスト</h3>

  <p>ASINやカテゴリーを指定してウォッチリストに追加できます。</p>

  <p>ウォッチリストに追加したアイテムは1日1回は商品情報が更新されます。</p>

  <h3>カテゴリーをウォッチリストに追加</h3>

  <p><a href="{{ route('browselist') }}">ブラウズリスト</a>にあるカテゴリーはそのまま表示して追加できますがリストにないカテゴリーも追加できます。</p>

  <p>例：Amazonで本カテゴリーのURL https://www.amazon.co.jp/%E6%9C%AC-%E9%80%9A%E8%B2%A9/b/?ie=UTF8&node=465392
    これの<code>node=</code>の後ろがIDになるので https://abs.kawax.biz/browse/ にIDを付けて https://abs.kawax.biz/browse/465392
    で表示するとウォッチリストに追加できます。
  </p>

  <p>ID指定しても表示できないカテゴリーもあります。</p>

  <h3>CSVファイルでダウンロード</h3>

  <p>ウォッチリストに追加したアイテムの商品情報をCSVでダウンロードできます。</p>

  <p>文字コード：UTF-8</p>

  <p>現在は{{ config('amazon.csv_limit') }}件分まで。CSVに含める項目や件数はいくらでも変更できるので需要次第。</p>

  <h3>グラフ</h3>

  <p>価格・ランキング・出品数のグラフ。ログイン中のユーザーにしか表示されません。スマホサイズでは綺麗に表示できないので非表示。</p>

  <div class="uk-child-width-1-2@m" uk-grid>
    <div class="uk-margin">
      <img src="{{ asset('image/usage_graph.jpg') }}" alt="" class="uk-border-rounded uk-box-shadow-large uk-padding">
    </div>
  </div>

  <h3>禁止行為</h3>

  <p>当サイトに対するスクレイピングは禁止します。AmazonのAPI使えばいいだけのこと。</p>

  <h3>無料で使えますか？</h3>

  <p>現時点では無料で使えます。ただし莫大な量のデータを保存するサービスに変わったので一部機能をオプションとして有料化の可能性はあります。</p>

  <ul class="uk-list uk-list-bullet">
    <li>ASINカウント : {{ $items_count or '0' }}</li>
    <li>履歴カウント : {{ $histories_count or '0' }}</li>
    <li>カテゴリーカウント : {{ $browses_count or '0' }}</li>
  </ul>

  <p>洋書カテゴリーは日本向けとしてはそんなの需要ない割に異常に数が多すぎて圧迫してるので定期的に削除するようにしました。洋書だけで半分以上。洋書のデータが欲しい場合は今後始めるかもしれない有料サービスをお待ち下さい。</p>
@endsection
