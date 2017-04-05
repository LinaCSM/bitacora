<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Falla extends Model
{
	protected $table='fallas';
	protected $guarder= 'id';
	protected $fillable=['fecha','n_caso','descripcion','estado','tipo','solucion','r_proceso','FK_Proceso'];
}
?>