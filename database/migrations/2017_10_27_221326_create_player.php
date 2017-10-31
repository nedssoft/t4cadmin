<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->string('name')->nullable(); //player name, nullable because they can decide not to give us name
            $table->string('username'); // display name
            $table->string('phone')->nullable(); // display name
            $table->string('email')->unique(); 
            $table->string('password');                                
            $table->string('token')->unique();                                
            $table->increments('id');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players');
    }
}