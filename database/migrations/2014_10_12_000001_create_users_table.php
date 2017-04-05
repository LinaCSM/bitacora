<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

        $table->increments('id');
            $table->integer('identificacion')->unique();
            $table->string('name');
            $table->string('lastname');
            $table->string('user_red')->unique();
            $table->string('password', 60);
            $table->integer('attempts');
            $table->enum('state',['Activo','Inactivo']);
            $table->string('justificacion')->nullable();
            $table->string('registro')->nullable();
            $table->rememberToken();

            /*FK de Tipo*/
            $table->integer('FK_Tipo')->unsigned(); 
            $table->foreign('FK_Tipo')
            ->references('id')
            ->on('tipos')
            ->onUpdate('cascade');

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
        Schema::drop('users');
    }
}
