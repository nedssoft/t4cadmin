<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('questions', function($table) {      
        //     $table->foreign('categories_id')->references('id')->on('categories');
        // });
    
        // Schema::table('questions', function($table) {      
        //     $table->foreign('level_id')->references('id')->on('levels');
        // });

        // Schema::table('sub_categories', function($table) {      
        //     $table->foreign('categories_id')->references('id')->on('categories')->onDelete('cascade');;
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
