<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Entregas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entregas', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->time('hora_final')->nullable();
            $table->string('registro');
            $table->enum('estado',['Exitoso','En ejecucion','Fallido','No se ejecuta']);
            $table->string('justificacion')->nullable();

            /*FK de Asignacion*/
            $table->integer('FK_Asignacion')->unsigned(); 
            $table->foreign('FK_Asignacion')
            ->references('id')
            ->on('asignacion')
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
        Schema::drop('entregas');
    }
}
