<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
	protected $table='asignacion';
	protected $guarder= 'id';
	protected $fillable=['FK_Proceso','FK_Entregable'];
}
?>