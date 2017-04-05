<?php

use Illuminate\Database\Seeder;

class Tipo_Analista2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tipos')->insert(array(
			'nombre' => 'Analista2'
		));
    }
}
