<?php

use Illuminate\Database\Seeder;

class A17X24N extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert(array(
            'identificacion' => '12345',
			'name' => 'A17X24N',
            'lastname' => 'O',
			'user_red' => 'A17X24N',
			'password' => \Hash::make('123456'),
			'attempts' => '0',
			'state' => 'Activo',
			'FK_Tipo' => '4'
		));
    }
}
