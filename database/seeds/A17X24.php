<?php

use Illuminate\Database\Seeder;

class A17X24 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \DB::table('users')->insert(array(
            'identificacion' => '1234',
			'name' => 'A17X24',
            'lastname' => 'O',
			'user_red' => 'A17X24',
			'password' => \Hash::make('123456'),
			'attempts' => '0',
			'state' => 'Activo',
			'FK_Tipo' => '3'
		));
    }
}
