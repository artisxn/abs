<?php
return [
    'locales' => [
        'BR' => [
            'name'       => 'Brazil',
            'tld'        => 'com.br',
            'tag'        => env('AMAZON_ASSOCIATE_TAG_BR'),
            'api_key'    => env('AMAZON_API_KEY_BR', env('AMAZON_API_KEY_WORLD')),
            'api_secret' => env('AMAZON_API_SECRET_BR', env('AMAZON_API_SECRET_KEY_WORLD')),
        ],
        'CA' => [
            'name'       => 'Canada',
            'tld'        => 'ca',
            'tag'        => env('AMAZON_ASSOCIATE_TAG_CA'),
            'api_key'    => env('AMAZON_API_KEY_CA', env('AMAZON_API_KEY_WORLD')),
            'api_secret' => env('AMAZON_API_SECRET_CA', env('AMAZON_API_SECRET_KEY_WORLD')),
        ],
        'CN' => [
            'name'       => 'China',
            'tld'        => 'cn',
            'tag'        => env('AMAZON_ASSOCIATE_TAG_CN'),
            'api_key'    => env('AMAZON_API_KEY_CN', env('AMAZON_API_KEY_WORLD')),
            'api_secret' => env('AMAZON_API_SECRET_CN', env('AMAZON_API_SECRET_KEY_WORLD')),
        ],
        'FR' => [
            'name'       => 'France',
            'tld'        => 'fr',
            'tag'        => env('AMAZON_ASSOCIATE_TAG_FR'),
            'api_key'    => env('AMAZON_API_KEY_FR', env('AMAZON_API_KEY_WORLD')),
            'api_secret' => env('AMAZON_API_SECRET_FR', env('AMAZON_API_SECRET_KEY_WORLD')),
        ],
        'DE' => [
            'name'       => 'Germany',
            'tld'        => 'de',
            'tag'        => env('AMAZON_ASSOCIATE_TAG_DE'),
            'api_key'    => env('AMAZON_API_KEY_DE', env('AMAZON_API_KEY_WORLD')),
            'api_secret' => env('AMAZON_API_SECRET_DE', env('AMAZON_API_SECRET_KEY_WORLD')),
        ],
        'IN' => [
            'name'       => 'India',
            'tld'        => 'in',
            'tag'        => env('AMAZON_ASSOCIATE_TAG_IN'),
            'api_key'    => env('AMAZON_API_KEY_IN', env('AMAZON_API_KEY_WORLD')),
            'api_secret' => env('AMAZON_API_SECRET_IN', env('AMAZON_API_SECRET_KEY_WORLD')),
        ],
        'IT' => [
            'name'       => 'Italy',
            'tld'        => 'it',
            'tag'        => env('AMAZON_ASSOCIATE_TAG_IT'),
            'api_key'    => env('AMAZON_API_KEY_IT', env('AMAZON_API_KEY_WORLD')),
            'api_secret' => env('AMAZON_API_SECRET_IT', env('AMAZON_API_SECRET_KEY_WORLD')),
        ],
        'JP' => [
            'name'       => 'Japan',
            'tld'        => 'co.jp',
            'tag'        => env('AMAZON_ASSOCIATE_TAG_JP'),
            'api_key'    => env('AMAZON_API_KEY_JP', env('AMAZON_API_KEY_WORLD')),
            'api_secret' => env('AMAZON_API_SECRET_JP', env('AMAZON_API_SECRET_KEY_WORLD')),
        ],
        'MX' => [
            'name'       => 'Mexico',
            'tld'        => 'com.mx',
            'tag'        => env('AMAZON_ASSOCIATE_TAG_MX'),
            'api_key'    => env('AMAZON_API_KEY_MX', env('AMAZON_API_KEY_WORLD')),
            'api_secret' => env('AMAZON_API_SECRET_MX', env('AMAZON_API_SECRET_KEY_WORLD')),
        ],
        'ES' => [
            'name'       => 'Spain',
            'tld'        => 'es',
            'tag'        => env('AMAZON_ASSOCIATE_TAG_ES'),
            'api_key'    => env('AMAZON_API_KEY_ES', env('AMAZON_API_KEY_WORLD')),
            'api_secret' => env('AMAZON_API_SECRET_ES', env('AMAZON_API_SECRET_KEY_WORLD')),
        ],
        'UK' => [
            'name'       => 'United Kingdom',
            'tld'        => 'co.uk',
            'tag'        => env('AMAZON_ASSOCIATE_TAG_UK'),
            'api_key'    => env('AMAZON_API_KEY_UK', env('AMAZON_API_KEY_WORLD')),
            'api_secret' => env('AMAZON_API_SECRET_UK', env('AMAZON_API_SECRET_KEY_WORLD')),
        ],
        'US' => [
            'name'       => 'United States',
            'tld'        => 'com',
            'tag'        => env('AMAZON_ASSOCIATE_TAG_US'),
            'api_key'    => env('AMAZON_API_KEY_US', env('AMAZON_API_KEY_WORLD')),
            'api_secret' => env('AMAZON_API_SECRET_US', env('AMAZON_API_SECRET_KEY_WORLD')),
        ],
    ],
];
