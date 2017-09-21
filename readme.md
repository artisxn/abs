# laravel-amazon

大昔に作ったAmazon検索ツールをLaravelで作り直した。昔は時間かけて調べたけど今なら数時間で終わる。(2016)

https://abs.kawax.biz/

## CHANGELOG

Product Advertising API だけ使ってたけど他のAPIも使って機能追加していく。
 
### Login with Amazon 2017-09-13
https://login.amazon.com/

Amazonアカウントでログイン。現状はログインだけで他にはなにもない。

### APIパッケージ部分を分離 2017-09-15
https://github.com/kawax/laravel-amazon-product-api

### ブラウズリスト更新コマンド 2017-09-15
`php artisan abs:browselist`
ローカルで実行用。

### 履歴 2017-09-16
価格情報などの履歴を保存。変動チェックのための準備。

### ウォッチリスト 2017-09-16
Amazonアカウントでログインすると使える。

### Publisherなどから検索へリンク 2017-09-18
昔はタグとして個別ページを作ってた気がする。今はとりあえず簡易的な検索。

### Laravel Voyager で管理画面のテスト 2017-09-22
