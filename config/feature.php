<?php
return [
    /**
     * 機能スイッチ
     */

    /**
     * ホームのabout
     */
    'about'                    => env('FEATURE_ABOUT', true),

    /**
     * CSV
     */
    'csv_download'             => env('FEATURE_CSV_DOWNLOAD', true),

    /**
     * プライバシーポリシーページ
     */
    'privacy'                  => env('FEATURE_PRIVACY', true),

    /**
     * 非公開
     * 社内専用など非公開にしたい場合オン
     */
    'closed'                   => env('FEATURE_CLOSED', false),

    /**
     * シングルユーザー
     * 指定のユーザーIDのみ有効。非公開と共に。
     */
    'single_user'              => env('FEATURE_SINGLE_USER', false),
    'single_user_id'           => env('FEATURE_SINGLE_USER_ID', 1),

    /**
     * Amazonアカウント以外にパスワードでのログインも許可。
     * 基本的にはデバッグ用。ユーザー向けには解放しない。
     * FEATURE_PASSWORDと同じかしかチェックしてない。
     */
    'password_login'           => env('FEATURE_PASSWORD_LOGIN', false),
    'password'                 => env('FEATURE_PASSWORD', ''),


    /**
     * ホームのランダムブラウズ
     * 自動でASIN情報を集めるので無駄なASINは不要な場合はオフ
     */
    'random_browse'            => env('FEATURE_RANDOM_BROWSE', true),

    /**
     * 最近のアイテム
     */
    'recent_item'              => env('FEATURE_RECENT_ITEM', true),

    /**
     * 更新日の古いアイテムを更新
     */
    'update_old_item'          => env('FEATURE_UPDATE_OLD_ITEM', true),

    /**
     * 更新日の古いアイテムを削除
     */
    'delete_old_item'          => env('FEATURE_DELETE_OLD_ITEM', false),

    /**
     * 除外リスト(amazon.delete_category)のカテゴリーのアイテム情報をDBから削除
     */
    'delete_category'          => env('FEATURE_DELETE_CATEGORY', true),

    /**
     * 世界機能のオンオフ
     */
    'world'                    => env('FEATURE_WORLD', false),

    /**
     * 指定したユーザーIDのウォッチリストから世界のアイテム情報を集める
     */
    'world_watch_item'         => env('FEATURE_WORLD_WATCH_ITEM', false),
    'world_watch_item_user_id' => env('FEATURE_WORLD_WATCH_ITEM_USER_ID', 1),

    'world_watch_item_locales'    => explode(',', env('FEATURE_WORLD_LOCALES', 'JP,US')),

    /**
     * APIキー。基本的にはJPアカウントで作ったもの。上手く動かない場合は各国でキーを作ってamazon-worldで指定
     */
    'world_amazon_api_key'        => env('AMAZON_API_KEY_WORLD'),
    'world_amazon_api_secret_key' => env('AMAZON_API_SECRET_KEY_WORLD'),

    /**
     * ウォッチリストのアイテムを1日1回更新
     * 上のworld有効時に不要ならオフ
     */
    'watch_item'                  => env('FEATURE_WATCH_ITEM', true),

    /**
     * ASIN/JANリストのCSVをアップロードしてウォッチリストに追加
     */
    'csv_import'                  => env('FEATURE_CSV_IMPORT', true),

    /**
     * プランページ
     */
    'plan'                        => env('FEATURE_PLAN', false),


    /**
     * CSVにImageSetsを含める
     */
    'export_image_sets'           => env('FEATURE_EXPORT_IMAGE_SETS', false),

    /**
     * API
     */
    'api'                         => env('FEATURE_API', true),

    /**
     * 価格チェック
     */
    'price_alert'                 => env('FEATURE_PRICE_ALERT', true),

    /**
     * 価格チェック。高速版
     */
    'price_alert_express'         => env('FEATURE_PRICE_ALERT_EXPRESS', false),

    /**
     * メールで通知
     */
    'notify_mail'                 => env('FEATURE_NOTIFY_MAIL', false),

    /**
     * PriceAlertカテゴリーの古いPostを削除
     * Postに残ってる間は再通知しない→一定期間後に削除して再通知可能に。
     */
    'delete_old_post'             => env('FEATURE_DELETE_OLD_POST', true),

    /**
     * マストドンへの通知。
     */
    'mastodon'                    => env('FEATURE_MASTODON', false),
    'mastodon_url'                => env('FEATURE_MASTODON_URL'),

    /**
     * DBに詳細データを保存するかどうか。データ量が大きくなるので不要ならオフ。
     * image_setsが一番大きい。
     */
    'save_item_attributes'        => env('FEATURE_SAVE_ITEM_ATTRIBUTES', true),
    'save_offer_summary'          => env('FEATURE_SAVE_OFFER_SUMMARY', true),
    'save_offers'                 => env('FEATURE_SAVE_OFFERS', true),
    'save_image_sets'             => env('FEATURE_SAVE_IMAGESETS', true),

    /**
     * 特集ページ
     */
    'feature_page'                => env('FEATURE_PAGE', false),
    'feature_game'                => env('FEATURE_GAME', false),

];
