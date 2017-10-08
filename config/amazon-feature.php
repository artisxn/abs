<?php
return [
    /**
     * 機能スイッチ
     */


    /**
     * 非公開
     * 社内専用など非公開にしたい場合オン
     */
    'closed' => env('FEATURE_CLOSED', false),

    /**
     * ホームのランダムブラウズ
     * 自動でASIN情報を集めるので無駄なASINは不要な場合はオフ
     */
    'random-browse' => env('FEATURE_RANDOM_BROWSE', true),

];
