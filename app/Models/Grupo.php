<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
	protected $table='grupos';
	protected $guarder= 'id';
	protected $fillable=['nombre','descripcion','estado','justificacion','registro','FK_Pais'];
}
?>