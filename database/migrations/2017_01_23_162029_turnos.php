<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Turnos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('turnos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->time('hora_inicio');
            $table->time('hora_final');
            $table->enum('estado',['Activo','Inactivo']);
            $table->string('justificacion')->nullable();
            $table->string('registro')->nullable();
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
        Schema::drop('turnos');
    }
}
