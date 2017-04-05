<?php

use Illuminate\Database\Seeder;


class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{
		\DB::table('users')->insert(array(
			'identificacion' => '12348',
			'name' => 'ABCD',
			'lastname' => 'O',
			'user_red' => 'admin',
			'password' => \Hash::make('123456789'),
			'attempts' => '0',
			'state' => 'Activo',
			'FK_Tipo' => '1'
			));
	}
}