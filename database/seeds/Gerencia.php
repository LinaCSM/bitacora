<?php

use Illuminate\Database\Seeder;

class Gerencia extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert(array(
            'identificacion' => '12341',
			'name' => 'Gerencia',
            'lastname' => 'O',
			'user_red' => 'Gerencia',
			'password' => \Hash::make('123456'),
			'attempts' => '0',
			'state' => 'Activo',
			'FK_Tipo' => '7'
		));
    }
}
