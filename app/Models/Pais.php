<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
	protected $table='paises';
	protected $guarder= 'id';
	protected $fillable=['nombre','estado','justificacion','registro'];
}
?>