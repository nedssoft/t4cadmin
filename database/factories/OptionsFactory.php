<?php

use Faker\Generator as Faker;

$factory->define(App\Options::class, function (Faker $faker) {
    
    return [
        'option' => $faker->sentence,
    ];
});
