<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cargue_Grupo extends Model
{
	protected $table='cargue_grupo';
	protected $guarder= 'id';
	protected $fillable=['FK_Cargue','FK_Grupo'];
}
?>