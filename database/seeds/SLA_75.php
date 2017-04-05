<?php

use Illuminate\Database\Seeder;

class SLA_75 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('sla')->insert(array(
            'porcentaje' => '75',
			'hora_atraso' => '01:00:00',
            'Estado' => 'Activo'
        ));
    }
}
