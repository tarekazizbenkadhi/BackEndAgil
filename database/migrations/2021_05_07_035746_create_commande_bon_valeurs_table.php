<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandeBonValeursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commande_bon_valeurs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->integer('nb_carnet15_ss');
            $table->integer('nb_carnet30_ss');
            $table->integer('nb_carnet50_ss');
            $table->integer('nb_carnet15_g');
            $table->integer('nb_carnet30_g');
            $table->integer('nb_carnet50_g');
            $table->integer('nb_carnet15_g50');
            $table->integer('nb_carnet30_g50');
            $table->integer('nb_carnet50_g50');
            $table->string('etat');
            $table->string('reglemment');
            $table->double('montant');




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
        Schema::dropIfExists('commande_bon_valeurs');
    }
}
