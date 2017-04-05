<?php

use Illuminate\Database\Seeder;

class SLA_0 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('sla')->insert(array(
            'porcentaje' => '0',
			'hora_atraso' => '04:00:00',
            'Estado' => 'Activo'
        ));
    }
}
