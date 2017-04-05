<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProcesoFalla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proceso_falla', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            /*FK de Cargue*/
            $table->integer('FK_Proceso')->unsigned(); 
            $table->foreign('FK_Proceso')
            ->references('id')
            ->on('procesos')
            ->onUpdate('cascade');
            
            /*FK de Grupo*/
            $table->integer('FK_Falla')->unsigned();    
            $table->foreign('FK_Falla')
            ->references('id')
            ->on('fallas')
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
        Schema::drop('proceso_falla');
    }
}
