<?php

use Illuminate\Database\Seeder;

class Analista2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert(array(
            'identificacion' => '12349',
            'name' => 'Analista2',
            'lastname' => 'O',
			'user_red' => 'Analista2',
			'password' => \Hash::make('123456'),
			'attempts' => '0',
			'state' => 'Activo',
			'FK_Tipo' => '2'
		));
    }
}
