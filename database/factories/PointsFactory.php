<?php

use Faker\Generator as Faker;

$factory->define(App\Points::class, function (Faker $faker) {
    
    return [
        'value' => $faker->randomDigitNotNull(),
        'amount' => $faker->numberBetween(50, 1000)
    ];
});
