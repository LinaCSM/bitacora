<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Frecuencia extends Model
{
	protected $table='frecuencias';
	protected $guarder= 'id';
	protected $fillable=['nombre','estado','justificacion','registro'];
}
?>