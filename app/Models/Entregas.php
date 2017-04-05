<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entregas extends Model
{
    protected $table='entregas';
	protected $guarder= 'id';
	protected $fillable=['fecha','hora_final','registro','estado','justificacion','FK_Asignacion'];
}
