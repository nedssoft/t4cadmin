<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Questions::class, 5)->create()->each(function ($question) {
            //Save options
            $question->options()->saveMany(factory(App\Options::class, 4)->make());
            //Attach categories
            $categories = \App\Category::pluck('id');
            $question->categories()->attach($categories->random(mt_rand(1, 3))); //Attach 1 to 3 cats
        });
    }
}
