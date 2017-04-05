<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cargue extends Model
{
    protected $table = 'cargues';
    protected $guarder = 'id';
    protected $fillable = ['nombre', 'tipo_archivo', 'plataforma', 'servidor', 'catalogo', 'bd', 'job', 'tarea','ruta', 'periodicidad', 'hora_ejecucion', 'estado', 'justificacion', 'registro', 'FK_Tipo'];
}
?>