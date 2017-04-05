<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proceso as Proceso;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        setlocale(LC_TIME, config('app.locale'));/*Fechas en español*/

        $horaProx = Carbon::now();
        $horaProx =$horaProx->addHour();
        $horaProx =$horaProx->toTimeString();


        $procesosDiarios=Proceso::orderBy('created_at','DESC')
            ->select('procesos.*', 'grupos.nombre as FK_Grupo', 'grupos.FK_Pais',
                'tipos.nombre as FK_Tipo', 'paises.nombre as FK_Pais',
                'frecuencias.nombre as FK_Frecuencia')
            ->join('tipos','procesos.FK_Tipo','=','tipos.id')
            ->join('frecuencia_proceso','frecuencia_proceso.FK_Proceso','=','procesos.id')
            ->join('frecuencias','frecuencia_proceso.FK_Frecuencia','=','frecuencias.id')
            ->join('grupos','procesos.FK_Grupo','=','grupos.id')
            ->join('paises','grupos.FK_Pais','=','paises.id')
            ->where('frecuencias.nombre', '=', 'diaria');
           // ->whereBetween('procesos.horario', [Carbon::now()->toTimeString(), $horaProx]);

        $procesosMensuales = Proceso::orderBy('created_at', 'DESC')
            ->select('procesos.*', 'grupos.nombre as FK_Grupo', 'grupos.FK_Pais',
                'tipos.nombre as FK_Tipo', 'paises.nombre as FK_Pais',
                'frecuencias.nombre as FK_Frecuencia')
            ->join('frecuencia_proceso', 'frecuencia_proceso.FK_Proceso', '=', 'procesos.id')
            ->join('frecuencias', 'frecuencia_proceso.FK_Frecuencia', '=', 'frecuencias.id')
            ->join('tipos', 'procesos.FK_Tipo', '=', 'tipos.id')
            ->join('grupos', 'procesos.FK_Grupo', '=', 'grupos.id')
            ->join('paises', 'grupos.FK_Pais', '=', 'paises.id')
            ->where('procesos.estado','=','Activo')
            ->where('frecuencias.nombre','=','Mensual')
            ->where('frecuencia_proceso.dia','=',Carbon::now()->day);
           // ->whereBetween('procesos.horario', [Carbon::now()->toTimeString(), $horaProx]);

        $procesosSemanales = Proceso::orderBy('created_at', 'DESC')
            ->select('procesos.*', 'grupos.nombre as FK_Grupo', 'grupos.FK_Pais',
                'tipos.nombre as FK_Tipo', 'paises.nombre as FK_Pais',
                'frecuencias.nombre as FK_Frecuencia')
            ->join('frecuencia_proceso', 'frecuencia_proceso.FK_Proceso', '=', 'procesos.id')
            ->join('frecuencias', 'frecuencia_proceso.FK_Frecuencia', '=', 'frecuencias.id')
            ->join('tipos', 'procesos.FK_Tipo', '=', 'tipos.id')
            ->join('grupos', 'procesos.FK_Grupo', '=', 'grupos.id')
            ->join('paises', 'grupos.FK_Pais', '=', 'paises.id')
            ->distinct('procesos.id')
            ->where('procesos.estado','=','Activo')
            ->where('frecuencias.nombre','=','Semanal')
            ->where(function ($query){
                $query->where('frecuencia_proceso.dia', '=', Carbon::now()->day)
                    ->orWhere('frecuencia_proceso.dia', '=', ucfirst(Carbon::now()->formatLocalized('%A')));
            })
            //->whereBetween('procesos.horario', [Carbon::now()->toTimeString(), $horaProx])
            ->union($procesosMensuales)
            ->union($procesosDiarios)
            ->get();

        return view('home', compact('procesosSemanales'));
    }

    public static function prueba(){
        $horaProx = Carbon::now();
        $horaProx =$horaProx->subDay();
        $horaProx =$horaProx->toDateString();

        return $horaProx;
    }
}



