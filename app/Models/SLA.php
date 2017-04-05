<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SLA extends Model
{
	protected $table='SLA';
	protected $guarder= 'id';
	protected $fillable=['porcentaje','hora_atraso','estado','justificacion','registro'];
}
?>