<?php

use Illuminate\Database\Seeder;

class SLA_50 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('sla')->insert(array(
            'porcentaje' => '50',
			'hora_atraso' => '02:00:00',
            'Estado' => 'Activo'
        ));
    }
}
