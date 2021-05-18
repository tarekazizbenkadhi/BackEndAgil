<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarteAgilisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carte_agilis', function (Blueprint $table) {
            $table->id();
            $table->boolean('mere_ss');
            $table->boolean('mere_g');
            $table->boolean('mere_g50');
            $table->integer('nb_carte_ss');
            $table->integer('nb_carte_g');
            $table->boolean('etat');
            $table->integer('nb_carte_g50');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('carte_agilis');
    }
}
