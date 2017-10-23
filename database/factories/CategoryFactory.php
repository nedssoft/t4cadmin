<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
	$cat = ['Hard', 'Easy', 'Intermediate', 'Expert'];

    return [
        'category'=>$faker->randomElement($cat),
    ];
});
