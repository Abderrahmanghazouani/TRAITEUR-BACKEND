<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->id('idDemande');
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('idClient')->on('clients')->onDelete('cascade');
            $table->string('description');
            $table->string('lieu');
            $table->dateTime('date_creation');
            $table->integer('nombre_personne');
            $table->string('type_de_celebration');
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
        Schema::dropIfExists('demandes');
    }
}

