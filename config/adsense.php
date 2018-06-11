<?php
return [
    /**
     * ポリシー違反と判断されるASINを除外
     * csvをダウンロードして置換
     * (.*)/asin/([a-z0-9]*),(.*)
     * '$2',
     */
    'ignore' => [
        '4198645507',
        '4575313645',
        '457614166X',
        '457615186X',
        '4576161342',
        '4576161881',
        '4576170813',
        '4801511422',
        '4817943939',
        'B004BH5FYE',
        'B00C8YNF8U',
        'B00KB3IAXU',
        'B00KNR57VC',
        'B07179BWJG',
        'B074RZQSTC',
        'B07542GJGN',
        'B075GKX26H',
        'B075R7YDBQ',
        'B076HGL7JR',
        'B076WYLK7D',
        'B077NXNQL8',
        'B077SNCLXX',
        'B078JKVP4X',
        'B078K4RNV3',
        'B078N8MC9L',
        'B078YJB834',
        'B079B4FPMD',
        'B079BHGK8G',
        'B079FSQFKC',
        'B07B45LY47',
        'B07B461N1Z',
        'B07BBV9H8T',
        'B07BHGFSNM',
        'B07BT6BCW1',
        'B07C2KM74T',
        'B07CMK4WC6',
    ],
];
