<?php

use Illuminate\Database\Seeder;

class SLA_100 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('sla')->insert(array(
            'porcentaje' => '100',
			'hora_atraso' => '00:00:00',
            'Estado' => 'Activo'
        ));
    }
}
