<?php
return [

    //最近のアイテムから除外するカテゴリー
    //洋書が多すぎなので除外。
    'recent_except'   => [
        52033011,
    ],

    //アイテム情報を削除するカテゴリー
    //洋書だけ多すぎなので削除していく
    'delete_category' => [
        52033011,
        52231011,
        97181011,
        2129039051,
        2570983051,
        100052011,
        2624415051,
        97635011,
    ],


    'locales' => [
        'BR' => [
            'name' => 'Brazil',
            'tld'  => 'com.br',
            'tag'  => env('AMAZON_ASSOCIATE_TAG_BR'),
        ],
        'CA' => [
            'name' => 'Canada',
            'tld'  => 'ca',
            'tag'  => env('AMAZON_ASSOCIATE_TAG_CA'),
        ],
        'CN' => [
            'name' => 'China',
            'tld'  => 'cn',
            'tag'  => env('AMAZON_ASSOCIATE_TAG_CN'),
        ],
        'FR' => [
            'name' => 'France',
            'tld'  => 'fr',
            'tag'  => env('AMAZON_ASSOCIATE_TAG_FR'),
        ],
        'DE' => [
            'name' => 'Germany',
            'tld'  => 'de',
            'tag'  => env('AMAZON_ASSOCIATE_TAG_DE'),
        ],
        'IN' => [
            'name' => 'India',
            'tld'  => 'in',
            'tag'  => env('AMAZON_ASSOCIATE_TAG_IN'),
        ],
        'IT' => [
            'name' => 'Italy',
            'tld'  => 'it',
            'tag'  => env('AMAZON_ASSOCIATE_TAG_IT'),
        ],
        'JP' => [
            'name' => 'Japan',
            'tld'  => 'co.jp',
            'tag'  => env('AMAZON_ASSOCIATE_TAG_JP'),
        ],
        'MX' => [
            'name' => 'Mexico',
            'tld'  => 'com.mx',
            'tag'  => env('AMAZON_ASSOCIATE_TAG_MX'),
        ],
        'ES' => [
            'name' => 'Spain',
            'tld'  => 'es',
            'tag'  => env('AMAZON_ASSOCIATE_TAG_ES'),
        ],
        'UK' => [
            'name' => 'United Kingdom',
            'tld'  => 'co.uk',
            'tag'  => env('AMAZON_ASSOCIATE_TAG_UK'),
        ],
        'US' => [
            'name' => 'United States',
            'tld'  => 'com',
            'tag'  => env('AMAZON_ASSOCIATE_TAG_US'),
        ],
    ],

    'default_priority' => env('DEFAULT_PRIORITY', 0),


    'csv_limit'  => env('CSV_LIMIT', 1000),

    //CSVのヘッダー。ItemResourceと合わせる。
    'csv_header' => [
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

    'analytics'     => env('GOOGLE_ANALYTICS', ''),

    //旧URLからのリダイレクト
    'redirect_from' => env('REDIRECT_FROM'),
    'redirect_to'   => env('REDIRECT_TO'),
];
