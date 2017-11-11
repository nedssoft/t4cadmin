<?php

use Faker\Generator as Faker;

$factory->define(App\Questions::class, function (Faker $faker) {

	 $cat_id = App\Category::pluck('id')->toArray();
     $level_id = App\Levels::pluck('id')->toArray();
     $point_id = App\Points::pluck('id')->toArray();
     
     return [
        //
        'category_id'=>$faker->randomElement($cat_id),
        'level_id' => $faker->randomElement($level_id),
        'point_id' => $faker->randomElement($point_id),
        'question' =>$faker->paragraph,
        'answer' =>$faker->sentence,
    ];
});
