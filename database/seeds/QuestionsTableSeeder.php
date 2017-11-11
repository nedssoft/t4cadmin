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
            $question->options()->saveMany(factory(App\Options::class, 4)->make());
        });
    }
}
