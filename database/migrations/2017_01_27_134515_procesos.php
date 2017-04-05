<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Procesos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procesos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('plataforma');
            $table->string('job');
            $table->string('servidor');
            $table->string('catalogo');
            $table->string('tarea_programada');
            $table->string('prerequisitos');
            $table->time('horario');
            $table->time('t_ejecucion');
            $table->string('sysdate');
            $table->enum('semaforo',['Si','No']);
            $table->enum('estado',['Activo','Inactivo','Bloqueado']);
            $table->string('justificacion')->nullable();

            /*FK de Grupo*/
            $table->integer('FK_Grupo')->unsigned(); 
            $table->foreign('FK_Grupo')
            ->references('id')
            ->on('grupos')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            /*FK de Turno*/
            $table->integer('FK_Turno')->unsigned(); 
            $table->foreign('FK_Turno')
            ->references('id')
            ->on('turnos')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            /*FK de Tipo*/
            $table->integer('FK_Tipo')->unsigned(); 
            $table->foreign('FK_Tipo')
            ->references('id')
            ->on('tipos')
            ->onUpdate('cascade')
            ->onDelete('cascade');

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
        Schema::drop('procesos');
    }
}
