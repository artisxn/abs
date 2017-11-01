@extends('layouts.master')

@section('title', 'ワールド APIドキュメント | ')

@section('content')

  @include('world.subnav')

  <h1 class="uk-heading-divider">ワールド APIドキュメント</h1>

  <h2 class="uk-heading-line"><span>認証</span></h2>

  <p>APIトークンを<a href="{{ route('settings.index') }}">設定ページ</a>で確認。ユーザー登録した時点でランダムなAPIトークンが生成されている。変更可能（60文字以下）。</p>

  <p>以降はこのAPIトークンを常に使う。</p>

  <h2 class="uk-heading-line"><span>APIトークンの指定方法</span></h2>

  <h3>1. Bearer</h3>
  リクエストヘッダーで指定。基本的にはこれを使用。

  <pre class="uk-background-muted"><code>Authorization: Bearer API_TOKEN</code></pre>

  <h3>2. GET時のquery</h3>
  <pre class="uk-background-muted"><code>GET /api/world?api_token=API_TOKEN</code></pre>

  <h3>3. POST時のbody</h3>

  <h2 class="uk-heading-line"><span>国コード</span></h2>
  <pre
    class="uk-background-muted"><code>{{ implode(',',config('feature.world_watch_item_locales')) }}</code></pre>

  <h2 class="uk-heading-line"><span>ウォッチリストに追加（ASIN）</span></h2>

  優先度を変更したい場合もこのAPIを使う。

  <pre class="uk-background-muted"><code>POST /api/watch/asin</code></pre>

  <h3>オプション</h3>
  <dl>
    <dt>asin</dt>
    <dd>必須。10文字のASINを指定。</dd>
    <dt>priority</dt>
    <dd>優先度。<code>0</code>か<code>1</code>。デフォルトは0。</dd>
  </dl>

  <h2 class="uk-heading-line"><span>ウォッチリストに追加（JAN/EAN）</span></h2>

  ASINとは違いJANからASINに変換して追加するのでAPIはインポートを開始するまで。優先度の指定はできない。

  <pre class="uk-background-muted"><code>POST /api/watch/ean</code></pre>

  <h3>オプション</h3>
  <dl>
    <dt>ean</dt>
    <dd>必須。13文字のJAN/EANを指定。</dd>
  </dl>


  <h2 class="uk-heading-line"><span>商品リストを取得</span></h2>

  <pre class="uk-background-muted"><code>GET /api/world</code></pre>

  <h3>レスポンス</h3>
  更新時間順の商品リスト。

  <h3>オプション</h3>
  <dl>
    <dt>country</dt>
    <dd><code>JP</code>、<code>JP,US</code>など国コードを指定。<code>,</code>区切りで複数指定。デフォルトはすべての国。</dd>
    <dt>search</dt>
    <dd>商品タイトル/ASIN/JANで検索。</dd>
    <dt>page</dt>
    <dd>ページ。デフォルト1。</dd>
    <dt>limit</dt>
    <dd>1ページ辺りの表示数。デフォルト50。</dd>
  </dl>

  <pre class="uk-background-muted"><code>GET /api/world?country=JP,US&search=test&page=2&limit=50</code></pre>

  <h2 class="uk-heading-line"><span>個別の商品データを取得</span></h2>

  <h3>ASINで指定</h3>
  <pre class="uk-background-muted"><code>GET /api/world/asin/{asin}</code></pre>

  <h3>JAN/EAN（13桁）で指定</h3>
  <pre class="uk-background-muted"><code>GET /api/world/ean/{ean}</code></pre>

  <h3>オプション</h3>
  <dl>
    <dt>country</dt>
    <dd><code>JP</code>、<code>JP,US</code>など国コードを指定。<code>,</code>区切りで複数指定。デフォルトはすべての国。</dd>
  </dl>

  <pre class="uk-background-muted"><code>GET /api/world/asin/0000000000?country=JP,US</code></pre>

  <h2 class="uk-heading-line"><span>商品データを即時更新</span></h2>

  これはPOSTメソッドにも対応。

  <pre class="uk-background-muted"><code>GET /api/world/update?asin=0000000000&country=JP</code></pre>

  <h3>レスポンス</h3>
  更新後の各ASINの商品データ。

  <h3>オプション</h3>
  <dl>
    <dt>asin</dt>
    <dd>必須。10桁のASINを指定。<code>,</code>区切りで複数指定。Amazon APIの仕様により最大10個まで。</dd>
    <dt>country</dt>
    <dd><code>JP</code>など国コードを指定。<strong>複数指定は不可</strong>。デフォルトはJP。</dd>
  </dl>

  <pre class="uk-background-muted"><code>GET /api/world/update?asin=0000000000,1111111111&country=US</code></pre>

  <h2 class="uk-heading-line"><span>商品リスト（新着）を取得</span></h2>

  <pre class="uk-background-muted"><code>GET /api/world/new</code></pre>

  <h3>レスポンス</h3>
  作成時間順の商品リスト。

  <h3>オプション</h3>
  <dl>
    <dt>since</dt>
    <dd><code>2017-10-22</code>など日付を指定。作成日が指定日以降の商品のみ。</dd>
    <dt>country</dt>
    <dd><code>JP</code>、<code>JP,US</code>など国コードを指定。<code>,</code>区切りで複数指定。デフォルトはすべての国。</dd>
    <dt>page</dt>
    <dd>ページ。デフォルト1。</dd>
    <dt>limit</dt>
    <dd>1ページ辺りの表示数。デフォルト50。</dd>
  </dl>

  <pre class="uk-background-muted"><code>GET /api/world/new?since=2017-10-22&country=JP&page=2&limit=50</code></pre>

@endsection
