<div class="uk-card uk-card-default uk-card-body">
  <h2 class="uk-card-title">このサイトについて</h2>
  <p>
    Amazon Product Advertising APIのデモサイトとして検索機能だけ使えるようにしてましたが現在は徐々に機能追加中。10-15年くらい使ってたURLも変更。
  </p>

  <p>現在、メール通知機能を全ユーザー向けに解放中。無効にしたい場合は設定ページから変更してください。</p>

  <h4>今後の予定</h4>
  <ul class="uk-list uk-list-bullet">
    <li>必要な機能は大体作ったので後は要望次第。</li>
    <li>MWS APIも使いたいけど出品者アカウントがない。</li>
  </ul>

  <h4>追加済み</h4>
  <ul class="uk-list uk-list-bullet">
    <li>Amazonアカウントでログイン</li>
    <li>ウォッチリスト</li>
    <li>CSVでダウンロード</li>
    <li>価格履歴などのグラフ（スマホサイズを除く。）</li>
    <li>価格変動チェック（ホームに表示版）</li>
    <li>ASIN/JANリストのCSVをインポートしてウォッチリストに追加</li>
    <li>ウォッチリストの価格変動チェック（各ユーザーに通知。ウェブプッシュ通知。メール通知。）</li>
    <li>当たり前のようにhttps化も。</li>
  </ul>

  <h4>カスタマイズ版の例</h4>
  <ul class="uk-list uk-list-bullet">
    <li><a href="https://abs-alert.kawax.biz/" target="_blank" rel="nofollow noopener">https://abs-alert.kawax.biz/</a>
    </li>
    <li>通知を優先した設定。</li>
    <li>ウォッチリストのアイテムの更新と変動チェックの間隔を短く。</li>
    <li>非公開設定なのでログインしないと見られない。</li>
    <li>自社サーバーで動かせば必要な機能だけ選んで運営できる。</li>
  </ul>

  <h4>データ</h4>
  データベースは20GB近くまでのデータ量になってるのでそろそろ古いデータは削除していくような調整が必要かも。

  <ul class="uk-list uk-list-bullet">
    <li>ASINカウント : {{ $items_count or '0' }}</li>
    <li>履歴カウント : {{ $histories_count or '0' }}</li>
    <li>カテゴリーカウント : {{ $browses_count or '0' }}</li>
  </ul>

  <h4>システム</h4>
  <ul class="uk-list uk-list-bullet">
    <li>AWS/EC2/RDS</li>
    <li>PHP {{ PHP_MAJOR_VERSION }}.{{ PHP_MINOR_VERSION }}/MySQL 5.7/Redis/memcached</li>
    <li>Laravel {{ app()->version() }}/Socialite/Horizon</li>
    <li>Vue.js/UIkit</li>
  </ul>
</div>
