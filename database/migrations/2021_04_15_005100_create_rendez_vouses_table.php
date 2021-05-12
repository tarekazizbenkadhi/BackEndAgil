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
            $table->boolean('8:30');
            $table->boolean('8:40');
            $table->boolean('8:50');
            $table->boolean('9:00');
            $table->boolean('9:10');
            $table->boolean('9:20');
            $table->boolean('9:30');
            $table->boolean('9:40');
            $table->boolean('9:50');
            $table->boolean('10:00');
            $table->boolean('10:10');
            $table->boolean('10:20');
            $table->boolean('10:30');
            $table->boolean('10:40');
            $table->boolean('10:50');
            $table->boolean('11:00');
            $table->boolean('11:10');
            $table->boolean('11:20');
            $table->boolean('11:30');
            $table->boolean('11:40');
            $table->boolean('11:50');
            $table->boolean('12:00');
            $table->boolean('12:10');
            $table->boolean('12:20');
            $table->boolean('12:30');
            $table->boolean('12:40');
            $table->boolean('12:50');
            $table->boolean('14:10');
            $table->boolean('14:20');
            $table->boolean('14:30');
            $table->boolean('14:40');
            $table->boolean('14:50');
            $table->boolean('15:00');
            $table->boolean('15:10');
            $table->boolean('15:20');
            $table->boolean('15:30');
            $table->boolean('15:40');
            $table->boolean('15:50');
            $table->boolean('16:00');
            $table->boolean('16:10');
            $table->boolean('16:20');
            $table->boolean('16:30');
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
