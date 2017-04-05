<?php

use Illuminate\Database\Seeder;

class Turno_Noche extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \DB::table('turnos')->insert(array(
            'nombre' => 'Noche',
			'hora_inicio' => '22:00:00',
            'hora_final' => '05:59:59',
			'estado' => 'Activo'
		));
    }
}
