<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;



class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{
		Model::unguard();

		/*Tipos*/
		$this->call('Tipo_Administrador');
		$this->call('Tipo_Analista2');
		$this->call('Tipo_A17X24');
		$this->call('Tipo_A17X24N');
		$this->call('Tipo_A1_AC');
		$this->call('Tipo_A1_WG');
		$this->call('Tipo_Gerencia');
		$this->call('Tipo_Cliente');

		/*Usuarios (Provisional)*/
		$this->call('AdminTableSeeder');
		$this->call('Analista2');
		$this->call('A17X24');
		$this->call('A17X24N');
		$this->call('A1_AC');
		$this->call('A1_WG');
		$this->call('Gerencia');
		$this->call('Cliente');

		/*SLA*/
		$this->call('SLA_100');
		$this->call('SLA_75');
		$this->call('SLA_50');
		$this->call('SLA_25');
		$this->call('SLA_0');
		
		/*Turnos*/
		$this->call('Turno_Mañana');
		$this->call('Turno_Tarde');
		$this->call('Turno_Noche');
		$this->call('Turno_Oficina');

		/*Frecuencias*/
		$this->call('Frecuencia_Diaria');
		$this->call('Frecuencia_Semanal');
		$this->call('Frecuencia_Mensual');
		$this->call('Frecuencia_Demanda');
		
	}
}
