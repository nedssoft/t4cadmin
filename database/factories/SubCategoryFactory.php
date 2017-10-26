<?php

use Faker\Generator as Faker;

$factory->define(App\SubCategory::class, function (Faker $faker) {

	$cat_id = App\Category::pluck('id')->all();
	$cat = array('Nature', 'Social', 'Science', 'Humanity');

    return [
    	'category_id'=>$faker->randomElement($cat_id),
        'name'=>$faker->randomElement($cat),
        'description'=>$faker->sentence,
        'imgUrl'=>$faker->imageUrl,
    ];
});
