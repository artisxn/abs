<div class="uk-card uk-card-default uk-card-body">
  <h2 class="uk-card-title">このサイトについて</h2>
  <p>
    Amazon Product Advertising APIのデモサイトとして検索機能だけ使えるようにしてましたが現在は徐々に機能追加中。追加済はAmazonアカウントでログインとウォッチリスト。10-15年くらい使ってたURLも変更。
  </p>
  <p>今後の予定は履歴データが増えたらグラフ化。商品データのCSVでダウンロード等。</p>
  <ul>
    <li>ASINカウント : （数十万件超えて重くなってきたので終了）</li>
    <li>履歴カウント : （重くなってきたので終了）</li>
    <li>カテゴリーカウント : {{ $browses_count or '0' }}</li>
  </ul>
</div>
