<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategorySettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('player_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('level_id')->unsigned();
            $table->integer('sub_category_id')->unsigned()->nullable();
            $table->string('number_of_questions');
            $table->timestamps();

            $table->foreign('player_id')
                ->references('id')->on('players')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('level_id')
                ->references('id')->on('levels')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('sub_category_id')
                ->references('id')->on('sub_categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_settings');
    }
}
