<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Watch::class, function (Faker $faker) {
    return [
        'asin_id' => $faker->randomDigit,
        'user_id' => $faker->randomDigit,
    ];
});
