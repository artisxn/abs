<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain'   => env('MAILGUN_DOMAIN'),
        'secret'   => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    //    'sparkpost' => [
    //        'secret' => env('SPARKPOST_SECRET'),
    //    ],

    //    'stripe' => [
    //        'model' => App\User::class,
    //        'key' => env('STRIPE_KEY'),
    //        'secret' => env('STRIPE_SECRET'),
    //    ],

    'amazon' => [
        'client_id'     => env('AMAZON_LOGIN_ID'),
        'client_secret' => env('AMAZON_LOGIN_SECRET'),
        'redirect'      => env('AMAZON_LOGIN_REDIRECT'),
    ],

    'mastodon' => [
        'domain'        => env('MASTODON_DOMAIN'),
        'client_id'     => env('MASTODON_ID'),
        'client_secret' => env('MASTODON_SECRET'),
        'redirect'      => env('MASTODON_REDIRECT'),
        //'read', 'write', 'follow'
        'scope'         => ['read', 'write', 'follow'],
        'token'         => env('MASTODON_TOKEN', ''),
    ],

    'discord' => [
        'token'   => env('DISCORD_BOT_TOKEN'),
        'channel' => env('DISCORD_CHANNEL'),
    ],
];
