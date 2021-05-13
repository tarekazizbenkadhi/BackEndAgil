<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntreprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entreprise', function (Blueprint $table) {
            $table->id();
            $table->string('raison_sociale');
            $table->string('activite');
            $table->string('forme_juridique');
            $table->string('responsable');
            $table->string('mobile');
            $table->string('email_res');
            $table->string('siege');
            $table->string('rib');
            $table->string('num_registre_commerce');
            $table->string('mat_fiscal');
            $table->string('matricule_fisc');
            $table->string('budget');
            $table->string('prevision');
            $table->boolean('valide');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->rememberToken();
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
        Schema::dropIfExists('entreprise');
    }
}
