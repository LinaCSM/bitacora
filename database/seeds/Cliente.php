<?php

use Illuminate\Database\Seeder;

class Cliente extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \DB::table('users')->insert(array(
            'identificacion' => '12340',
			'name' => 'Cliente',
            'lastname' => 'O',
			'user_red' => 'Cliente',
			'password' => \Hash::make('123456'),
			'attempts' => '0',
			'state' => 'Activo',
			'FK_Tipo' => '8'
		));
    }
}
