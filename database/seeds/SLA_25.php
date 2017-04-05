<?php

use Illuminate\Database\Seeder;

class SLA_25 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('sla')->insert(array(
            'porcentaje' => '25',
			'hora_atraso' => '03:00:00',
            'Estado' => 'Activo'
        ));
    }
}
