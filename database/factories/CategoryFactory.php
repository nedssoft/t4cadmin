<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
	$cat = array('Hard', 'Easy', 'Intermediate', 'Expert');

    return [
        'name'=>$faker->randomElement($cat),
        'description'=>$faker->sentence,
        'imgUrl'=>$faker->imageUrl,
    ];
});
