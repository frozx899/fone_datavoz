<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('rut')->nullable();
            $table->string('tipo')->nullable();
            $table->string('programa')->nullable();
            $table->string('nombre')->nullable();
            $table->string('sexo')->nullable();
            $table->string('pais')->nullable();
            $table->string('telefono1');
            $table->string('telefono2')->nullable();
            $table->string('telefono3')->nullable();
            $table->string('telefono4')->nullable();
            $table->string('telefono5')->nullable();
            $table->string('incidencia1')->nullable();
            $table->string('incidencia2')->nullable();
            $table->string('incidencia3')->nullable();
            $table->string('incidencia4')->nullable();
            $table->string('incidencia5')->nullable();
            $table->string('estado');
            $table->date('ultimo_contacto')->nullable();
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
        Schema::dropIfExists('contactos');
    }
};
