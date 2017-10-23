<?php

use Faker\Generator as Faker;

$factory->define(App\Question::class, function (Faker $faker) {

	 $cat_id = App\Category::pluck('id')->toArray();
	 $level_id = App\Level::pluck('id')->toArray();
    return [
        //
        'category_id'=>$faker->randomElement($cat_id),
        'level_id' =>$faker->randomElement($level_id),
        'question'=>$faker->paragraph,
        'option_1'=>$faker->sentence,
        'option_2'=>$faker->sentence,
        'option_3'=>$faker->sentence,
        'option_4'=>$faker->sentence,
        'answer'=>$faker->sentence,
    ];
});
