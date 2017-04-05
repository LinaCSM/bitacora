<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proceso_Falla extends Model
{
	protected $table='proceso_falla';
	protected $guarder= 'id';
	protected $fillable=['fecha','FK_Proceso','FK_Falla'];
}
?>