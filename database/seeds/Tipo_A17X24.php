<?php

use Illuminate\Database\Seeder;

class Tipo_A17X24 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tipos')->insert(array(
			'nombre' => 'A17X24'
		));
    }
}
