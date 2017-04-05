<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entregable extends Model
{
	protected $table='entregables';
	protected $guarder= 'id';
	protected $fillable=['ruta','tipo','estado','justificacion'];
	
}
?>