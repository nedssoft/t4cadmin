<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();            
            $table->integer('level_id')->unsigned();
            $table->integer('point_id')->unsigned();        
            $table->text('question');
            $table->string('answer');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            
            $table->foreign('category_id')
                  ->references('id')->on('categories')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('level_id')
                  ->references('id')->on('levels')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('point_id')
                  ->references('id')->on('points')
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
        Schema::dropIfExists('questions');
    }
}
