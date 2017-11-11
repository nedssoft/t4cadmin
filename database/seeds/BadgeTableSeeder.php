<?php

use Illuminate\Database\Seeder;

class BadgeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Badges::class, 5)->create();//creates 5 records
    }
}
