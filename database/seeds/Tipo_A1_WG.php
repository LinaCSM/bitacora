<?php

use Illuminate\Database\Seeder;

class Tipo_A1_WG extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tipos')->insert(array(
			'nombre' => 'A1_WG'
		));
    }
}
