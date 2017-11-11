<?php

use Faker\Generator as Faker;

$factory->define(App\Badges::class, function(Faker $faker) {

	$badges = array('Rookie', 'Sage');

    return [
       'name' => $faker->randomElement($badges),
       'icon' => $faker->imageUrl($width = 640, $height = 480),
       'points' => $faker->randomDigit(),
       'description'=> $faker->sentence,
    ];
});
