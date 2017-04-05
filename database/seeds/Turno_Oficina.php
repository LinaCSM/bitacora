<?php

use Illuminate\Database\Seeder;

class Turno_Oficina extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \DB::table('turnos')->insert(array(
            'nombre' => 'Oficina',
			'hora_inicio' => '06:00:00',
            'hora_final' => '18:00:00',
			'estado' => 'Activo'
		));
    }
}
