<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmdBonsLitresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cmd_bons_litres', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('qte_litres');
            $table->integer('nb_cartes_bons');
            $table->double('montant_litres');
            $table->string('etat_litres');
            $table->string('reglement_litres');
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
        Schema::dropIfExists('cmd_bons_litres');
    }
}
