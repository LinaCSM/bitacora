<?php

use Illuminate\Database\Seeder;

class Turno_Mañana extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \DB::table('turnos')->insert(array(
            'nombre' => 'Mañana',
			'hora_inicio' => '06:00:00',
            'hora_final' => '13:59:59',
			'estado' => 'Activo'
		));
    }
}
