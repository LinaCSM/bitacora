<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CargueGrupo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('cargue_grupo', function (Blueprint $table) {
            $table->increments('id');

            /*FK de Cargue*/
            $table->integer('FK_Cargue')->unsigned(); 
            $table->foreign('FK_Cargue')
            ->references('id')
            ->on('cargues')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            
            /*FK de Grupo*/
            $table->integer('FK_Grupo')->unsigned();    
            $table->foreign('FK_Grupo')
            ->references('id')
            ->on('grupos')
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
        Schema::drop('cargue_grupo');
    }
}
