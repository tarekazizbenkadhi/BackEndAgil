<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRendezVousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rendez_vouses', function (Blueprint $table) {
            $table->id();
            $table->boolean('a830');
            $table->boolean('a840');
            $table->boolean('a850');
            $table->boolean('a900');
            $table->boolean('a910');
            $table->boolean('a920');
            $table->boolean('a930');
            $table->boolean('a940');
            $table->boolean('a950');
            $table->boolean('a1000');
            $table->boolean('a1010');
            $table->boolean('a1020');
            $table->boolean('a1030');
            $table->boolean('a1040');
            $table->boolean('a1050');
            $table->boolean('a1100');
            $table->boolean('a1110');
            $table->boolean('a1120');
            $table->boolean('a1130');
            $table->boolean('a1140');
            $table->boolean('a1150');
            $table->boolean('a1200');
            $table->boolean('a1210');
            $table->boolean('a1220');
            $table->boolean('a1230');
            $table->boolean('a1240');
            $table->boolean('a1250');
            $table->boolean('a1410');
            $table->boolean('a1420');
            $table->boolean('a1430');
            $table->boolean('a1440');
            $table->boolean('a1450');
            $table->boolean('a1500');
            $table->boolean('a1510');
            $table->boolean('a1520');
            $table->boolean('a1530');
            $table->boolean('a1540');
            $table->boolean('a1550');
            $table->boolean('a1600');
            $table->boolean('a1610');
            $table->boolean('a1620');
            $table->boolean('a1630');
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
        Schema::dropIfExists('rendez_vouses');
    }
}
