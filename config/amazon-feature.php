<?php
return [
    /**
     * 機能スイッチ
     */


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
    'old_item'                 => env('FEATURE_OLD_ITEM', true),

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

    'world_watch_item_locales' => explode(',', env('FEATURE_WORLD_LOCALES', 'JP,US')),

    'world_amazon_api_key'        => env('AMAZON_API_KEY_WORLD'),
    'world_amazon_api_secret_key' => env('AMAZON_API_SECRET_KEY_WORLD'),

    /**
     * ウォッチリストのアイテムを1日1回更新
     * 上のworld有効時に不要ならオフ
     */
    'watch_item'                  => env('FEATURE_WATCH_ITEM', true),

    /**
     * JANリストのCSVをアップロードしてウォッチリストに追加
     */
    'jan_import'                  => env('FEATURE_JAN_IMPORT', false),

    /**
     * プランページ
     */
    'plan'                        => env('FEATURE_PLAN', false),

];
