<?php

use Illuminate\Database\Seeder;

class A1_WG extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         \DB::table('users')->insert(array(
            'identificacion' => '12347',
			'name' => 'A1-WG',
            'lastname' => 'O',
			'user_red' => 'A1-WG',
			'password' => \Hash::make('123456'),
			'attempts' => '0',
			'state' => 'Activo',
			'FK_Tipo' => '6'
		));
    }
}
