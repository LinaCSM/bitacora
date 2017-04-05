<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Entregables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entregables', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ruta');
            $table->enum('tipo',['Archivo excel','Archivo plano','Correo','Cubo','Tablas en oracle','Reporte excel','Reporte IBM COGNOS','Reporte ECON extension CSV','Reporte']);
            $table->enum('estado',['Activo','Inactivo','Bloqueado']);
            $table->string('justificacion')->nullable();
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
         Schema::drop('entregables');
    }
}
