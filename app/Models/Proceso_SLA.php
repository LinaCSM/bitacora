<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proceso_SLA extends Model
{
	protected $table='proceso_SLA';
	protected $guarder= 'id';
	protected $fillable=['fecha','FK_Proceso','FK_SLA','justificacion_SLA'];
}
?>