<?php

use Faker\Generator as Faker;

$factory->define(App\Model\WorldItem::class, function (Faker $faker) {
    return [
        'asin'    => str_random(10),
        'ean'     => str_random(13),
        'country' => $faker->randomElement(['JP', 'US', 'UK']),
        'title' => $faker->sentence,
        'rank' => $faker->randomNumber,
        'lowest_new_price' => $faker->randomNumber,
        'lowest_new_formatted_price' => $faker->randomNumber,
        'lowest_used_price' => $faker->randomNumber,
        'lowest_used_formatted_price' => $faker->randomNumber,
        'total_new' => $faker->randomNumber,
        'total_used' => $faker->randomNumber,
        'editorial_review' => $faker->text,
    ];
});
