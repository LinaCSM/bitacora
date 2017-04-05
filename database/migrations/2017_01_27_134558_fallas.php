<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Fallas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('fallas', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->string('n_caso');
            $table->string('descripcion');
            $table->enum('estado',['Solucionada','En espera']);
            $table->enum('tipo',['Endogena','Exogena']);
            $table->string('solucion')->nullable();
             $table->enum('r_proceso',['Si','No']);
            /*FK de Proceso*/
            $table->integer('FK_Proceso')->unsigned(); 
            $table->foreign('FK_Proceso')
            ->references('id')
            ->on('procesos')
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
        Schema::drop('fallas');
    }
}
