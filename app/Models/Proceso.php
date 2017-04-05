<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proceso extends Model
{
	protected $table='procesos';
	protected $guarder= 'id';
	protected $fillable=['nombre','plataforma','job','servidor','catalogo','tarea_programada',
		'prerequisitos','horario','t_ejecucion','sysdate','semaforo','estado','justificacion','FK_Grupo','Fk_Turno','FK_Tipo'];
}
?>