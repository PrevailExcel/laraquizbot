<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHighscoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('highscores', function (Blueprint $table) {
            $table->id();
            $table->integer('chat_id');
            $table->string('name');
            $table->integer('points')->default(0);
            $table->integer('correct_answers')->default(0);
            $table->integer('tries')->default(0);
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
        Schema::dropIfExists('highscores');
    }
}
