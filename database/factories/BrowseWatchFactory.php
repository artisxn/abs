<?php

use Faker\Generator as Faker;

$factory->define(App\Model\BrowseWatch::class, function (Faker $faker) {
    return [
        'browse_id' => $faker->randomDigit,
        'user_id' => $faker->randomDigit,
    ];
});
