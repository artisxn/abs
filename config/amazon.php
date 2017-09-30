<?php
return [
    'analytics' => env('GOOGLE_ANALYTICS', ''),

    'redirect_from' => env('REDIRECT_FROM'),
    'redirect_to'   => env('REDIRECT_TO'),

    'csv_limit'  => env('CSV_LIMIT', 1000),
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

    'login_button_img' => 'https://images-na.ssl-images-amazon.com/images/G/01/lwa/btnLWA_gold_390x92.png',

    'form'          => [
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

    //最近のアイテムから除外するカテゴリー
    //洋書が多すぎなので除外。
    'recent_except' => [
        52033011,
    ],
];
