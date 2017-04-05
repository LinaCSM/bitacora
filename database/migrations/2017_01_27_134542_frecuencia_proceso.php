<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FrecuenciaProceso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::create('frecuencia_proceso', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dia')->nullable();

            /*FK de Frecuencia*/
            $table->integer('FK_Frecuencia')->unsigned(); 
            $table->foreign('FK_Frecuencia')
            ->references('id')
            ->on('frecuencias')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            
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
        Schema::drop('frecuencia_proceso');
    }
}
