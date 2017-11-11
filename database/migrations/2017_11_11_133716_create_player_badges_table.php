<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerBadgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_badges', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('badge_id')->unsigned();
            $table->integer('player_id')->unsigned();

            $table->foreign('badge_id')
                ->references('id')->on('badges')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('player_id')
                ->references('id')->on('players')
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
        Schema::dropIfExists('player_badges');
    }
}
