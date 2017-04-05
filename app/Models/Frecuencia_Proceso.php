<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Frecuencia_Proceso extends Model
{
	protected $table='frecuencia_proceso';
	protected $guarder= 'id';
	protected $fillable=['dia','FK_Frecuencia','FK_Proceso'];
}
?>