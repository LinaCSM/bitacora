<?php

use Illuminate\Database\Seeder;

class Frecuencia_Demanda extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('frecuencias')->insert(array(
			'nombre' => 'Demanda',
            'estado' => 'Activo'
		));
    }
}
