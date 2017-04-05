<?php

use Illuminate\Database\Seeder;

class Turno_Tarde extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \DB::table('turnos')->insert(array(
            'nombre' => 'Tarde',
			'hora_inicio' => '14:00:00',
            'hora_final' => '21:59:59',
			'estado' => 'Activo'
		));
    }
}
