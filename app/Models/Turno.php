<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
	protected $table='turnos';
	protected $guarder= 'id';
	protected $fillable=['nombre','hora_inicio','hora_final','estado','justificacion','registro'];
}
?>