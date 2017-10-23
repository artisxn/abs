<?php
return [

    //最近のアイテムから除外するカテゴリー
    //洋書が多すぎなので除外。
    'recent_except'        => [
        52033011,
    ],

    //アイテム情報を削除するカテゴリー
    //洋書だけ多すぎなので削除していく
    'delete_category'      => [
        52033011,
        52231011,
        97181011,
        2129039051,
        2570983051,
        100052011,
        2624415051,
        97635011,
    ],

    //特典キー
    'special_key_personal' => env('SPECIAL_KEY_PERSONAL', ''),
    'special_key_business' => env('SPECIAL_KEY_BUSINESS', ''),


    'default_priority' => env('DEFAULT_PRIORITY', 0),

    /**
     * CSVダウンロードの制限
     */
    'csv_limit'        => env('CSV_LIMIT', 1000),

    //CSVのヘッダー。ItemResourceと合わせる。
    'csv_header'       => [
        'ASIN',
        'Title',
        'Ranking',
        'Binding',
        'Brand',
        'Publisher',
        'Author',
        'Creator',
        'Actor',
        'ReleaseDate',
        'LowestNewPrice',
        'TotalNew',
        'LowestUsedPrice',
        'TotalUsed',
        'Availability',
        'Updated_at',
        'LargeImage',
        'ImageSets',
        'DetailPageURL',
    ],

    //検索
    'form'             => [
        'All'                => 'すべて',
        'Books'              => '本',
        'Music'              => 'ミュージック',
        'DVD'                => 'DVD',
        'Electronics'        => '家電&カメラ',
        'Appliances'         => '大型家電',
        'VideoGames'         => 'TVゲーム',
        'Apparel'            => '服＆ファッション小物',
        'Toys'               => 'おもちゃ',
        'Software'           => 'PCソフト',
        'PCHardware'         => 'パソコン・周辺機器',
        'OfficeProducts'     => '文房具・オフィス用品',
        'HealthPersonalCare' => 'ヘルス&ビューティー',
        'Beauty'             => 'コスメ',
        'SportingGoods'      => 'スポーツ&アウトドア',
        'Shoes'              => 'シューズ＆バッグ',
        'Jewelry'            => 'ジュエリー',
        'Baby'               => 'ベビー&マタニティ',
        'Hobbies'            => 'ホビー',
        'Automotive'         => 'カー・バイク用品',
    ],

    // Login with Amazonの画像
    'login_button_img' => 'https://images-na.ssl-images-amazon.com/images/G/01/lwa/btnLWA_gold_390x92.png',

    'analytics'              => env('GOOGLE_ANALYTICS', ''),
    'analytics_verification' => env('GOOGLE_ANALYTICS_VERIFICATION', ''),

    //旧URLからのリダイレクト
    'redirect_from'          => env('REDIRECT_FROM'),
    'redirect_to'            => env('REDIRECT_TO'),
];
