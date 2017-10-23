<?php

use Faker\Generator as Faker;

$factory->define(App\Level::class, function (Faker $faker) {

	$level = ['basic', 'primary', 'undergraduate', 'advanced'];

    return [
        //
       'level'=>$faker->randomElement($level),
    ];
});
