<?php

use Illuminate\Database\Seeder;

class Tipo_Cliente extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tipos')->insert(array(
			'nombre' => 'Cliente'
		));
    }
}
