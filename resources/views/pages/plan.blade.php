@extends('layouts.master')

@section('title', 'プラン' . ' | ')


@section('content')

  <h2 class="uk-heading-divider">プラン</h2>

  <div class="uk-alert-danger" uk-alert>
    <p>内容はすべて未定です。将来的に始めるかもしれないサービスです。</p>
  </div>

  <table class="uk-table uk-table-striped uk-table-hover uk-table-divider">
    <caption></caption>
    <thead>
    <tr>
      <th></th>
      <th><strong>フリー</strong></th>
      <th><strong>パーソナル</strong></th>
      <th><strong>ビジネス</strong></th>
      <th><strong>エンタープライズ</strong></th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <th><strong>価格</strong></th>
      <td>無料</td>
      <td>?</td>
      <td>?</td>
      <td>?</td>
    </tr>

    <tr>
      <th><strong>ウォッチリスト上限</strong></th>
      <td>?</td>
      <td>?</td>
      <td>無制限</td>
      <td>無制限</td>
    </tr>

    <tr>
      <th><strong>CSVダウンロード件数</strong></th>
      <td>100</td>
      <td>10,000</td>
      <td>無制限</td>
      <td>無制限</td>
    </tr>

    <tr>
      <th><strong>エクスポート機能</strong><br>
        カテゴリーIDや件数を指定してのCSVダウンロード
      </th>
      <td><span uk-icon="icon: close"></span></td>
      <td><span uk-icon="icon: close"></span></td>
      <td><span uk-icon="icon: check"></span></td>
      <td><span uk-icon="icon: check"></span></td>
    </tr>

    <tr>
      <th><strong>管理者機能</strong></th>
      <td><span uk-icon="icon: close"></span></td>
      <td><span uk-icon="icon: close"></span></td>
      <td><span uk-icon="icon: close"></span></td>
      <td><span uk-icon="icon: check"></span></td>
    </tr>

    <tr>
      <th><strong>自社サーバーでの運営</strong><br>
        AWS(EC2+RDS)のみ対応。
      </th>
      <td><span uk-icon="icon: close"></span></td>
      <td><span uk-icon="icon: close"></span></td>
      <td><span uk-icon="icon: close"></span></td>
      <td><span uk-icon="icon: check"></span></td>
    </tr>

    <tr>
      <th><strong>チャットワークでのサポート</strong></th>
      <td><span uk-icon="icon: close"></span></td>
      <td><span uk-icon="icon: close"></span></td>
      <td><span uk-icon="icon: close"></span></td>
      <td><span uk-icon="icon: check"></span></td>
    </tr>

    <tr>
      <th><strong>支払い方法</strong><br>
      Stripeなどでの対応は予定なし</th>
      <td></td>
      <td>Enty（特典キー入力）</td>
      <td>Enty（特典キー入力）</td>
      <td>Entyまたはチャットワークで問い合わせ</td>
    </tr>

    </tbody>
  </table>

  <h3>エンタープライズプラン</h3>

  <p>当サイトと全く同じサービスを自社サーバーで運営できます。</p>

  <h4>メリット</h4>
  <ul class="uk-list uk-list-bullet">
    <li>多少の独自機能追加。海外Amazonからの情報も取得など。</li>
    <li>機能スイッチで不要な機能をオフ。</li>
    <li>RDSから直接データを参照できる。</li>
    <li>自社Amazonアカウントで運営することでAPIの使用制限を受けにくくなる。</li>
    <li>社内向けのみの非公開運営。</li>
  </ul>

  <h4>必要なこと</h4>
  <ul class="uk-list uk-list-bullet">
    <li>Amazon/AWS/API用のアカウント。</li>
    <li>ドメイン。サブドメインでも可。</li>
    <li>ソースを提供して自分で設置する方式ではありません。EC2+RDSの管理はこちらに任せてもらいます。バージョンアップは当サイトと同時に行います。</li>
  </ul>

  <h4>開始までのもう少し詳しい流れ</h4>
  <ul class="uk-list uk-list-bullet">
    <li>Amazonアカウントのログイン情報を教えてもらう。もしくは必要な作業ができる権限を持ったIAMユーザーの情報。</li>
    <li>EC2の設定はこちらで行います。WordPressが動く程度のサーバーでは機能が足りないのでこちらで設定しないと動きません。</li>
    <li>EC2はt2.micro以上、OSはUbuntu。すでに使ってるEC2の流用はできません。RDS(MySQL)なら流用できます。</li>

  </ul>
@endsection
