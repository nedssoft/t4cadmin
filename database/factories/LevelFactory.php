<?php

use Faker\Generator as Faker;

$factory->define(App\Levels::class, function (Faker $faker) {

	$level = array('basic', 'primary', 'undergraduate', 'advanced');

    return [
        //
       'name'=>$faker->randomElement($level),
       'description'=>$faker->sentence,
    ];
});
