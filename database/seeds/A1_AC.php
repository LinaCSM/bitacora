<?php

use Illuminate\Database\Seeder;

class A1_AC extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert(array(
            'identificacion' => '12346',
			'name' => 'A1-AC',
            'lastname' => 'O',
			'user_red' => 'A1-AC',
			'password' => \Hash::make('123456'),
			'attempts' => '0',
			'state' => 'Activo',
			'FK_Tipo' => '5'
		));
    }
}
