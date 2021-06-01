<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonsLitresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bons_litres', function (Blueprint $table) {
            $table->id('num_bon');
            $table->date('consumed_at');
            $table->boolean('etat_bon');
            $table->bigInteger('cmd_bons_litre_id')->unsigned();
            $table->foreign('cmd_bons_litre_id')->references('id')->on('cmd_bons_litres');
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
        Schema::dropIfExists('bons_litres');
    }
}
