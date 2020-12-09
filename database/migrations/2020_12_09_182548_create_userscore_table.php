<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserscoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userscores', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('userid');
            $table->integer('age')->unsigned();
            $table->double('duos_point');
            $table->integer('duos_kills')->unsigned();
            $table->integer('duos_wins')->unsigned();
            $table->double('solo_pont');
            $table->integer('solo_kills')->unsigned();
            $table->integer('solo_wins')->unsigned();
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
        Schema::dropIfExists('userscore');
    }
}
