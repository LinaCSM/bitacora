<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Asignacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignacion', function (Blueprint $table) {
            $table->increments('id');
            /*FK de Proceso*/
            $table->integer('FK_Proceso')->unsigned(); 
            $table->foreign('FK_Proceso')
            ->references('id')
            ->on('procesos')
            ->onUpdate('cascade')
            ->onDelete('cascade');


            /*FK de Entregable*/
            $table->integer('FK_Entregable')->unsigned(); 
            $table->foreign('FK_Entregable')
            ->references('id')
            ->on('entregables')
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
        Schema::drop('asignacion');
    }
}
