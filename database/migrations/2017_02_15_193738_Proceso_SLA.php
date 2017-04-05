<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProcesoSLA extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proceso_SLA', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
             /*FK de Proceso*/
            $table->integer('FK_Proceso')->unsigned(); 
            $table->foreign('FK_Proceso')
            ->references('id')
            ->on('procesos')
            ->onUpdate('cascade')
            ->onDelete('cascade');


            /*FK de SLA*/
            $table->integer('FK_SLA')->unsigned(); 
            $table->foreign('FK_SLA')
            ->references('id')
            ->on('SLA')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            
            $table->string('justificacion_SLA')->nullable();

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
       Schema::drop('proceso_SLA');
    }
}
