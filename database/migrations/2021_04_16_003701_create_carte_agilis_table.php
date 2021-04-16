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
            $table->bigInteger('num_carte')->unique();
            $table->bigInteger('user_id')->unsigned();
            $table->double('solde');
            $table->date('date_exp');
            $table->bigInteger('code_secret');
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
