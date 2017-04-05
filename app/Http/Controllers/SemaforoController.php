<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Proceso as Proceso;
use App\Models\Proceso_SLA as PSLA;

class SemaforoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        setlocale(LC_TIME, config('app.locale'));

        $tipoUsuario = \Auth::user()->FK_Tipo;

        if($tipoUsuario=="1" || $tipoUsuario=="2" || $tipoUsuario=="7") {
            $procesosSemaforo = Proceso::orderBy('horario', 'ASC')
                ->select('procesos.id','procesos.job','procesos.plataforma','tipos.nombre as FK_Tipo', 'grupos.nombre as FK_Grupo','paises.nombre as FK_Pais', 'turnos.nombre as FK_Turno',
                    'frecuencias.nombre as FK_Frecuencia')
                ->join('tipos', 'procesos.FK_Tipo', '=', 'tipos.id')
                ->join('grupos', 'procesos.FK_Grupo', '=', 'grupos.id')
                ->join('paises', 'grupos.FK_Pais', '=', 'paises.id')
                ->join('turnos', 'procesos.FK_Turno', '=', 'turnos.id')
                ->join('frecuencia_proceso', 'frecuencia_proceso.FK_Proceso', '=', 'procesos.id')
                ->join('frecuencias', 'frecuencia_proceso.FK_Frecuencia', '=', 'frecuencias.id')
                ->where('procesos.estado', '=', 'Activo')
                ->where('procesos.semaforo', '=', 'Si')
                ->where(function ($query){
                    $query->where('frecuencia_proceso.dia', '=', 'Todos')
                        ->orWhere('frecuencia_proceso.dia', '=', Carbon::now()->day)
                        ->orWhere('frecuencia_proceso.dia', '=', ucfirst(Carbon::now()->formatLocalized('%A')));
                })
                ->get();
        }else{
            $procesosSemaforo = Proceso::orderBy('horario', 'ASC')
                ->select('procesos.id','procesos.job','procesos.plataforma','tipos.nombre as FK_Tipo', 'grupos.nombre as FK_Grupo','paises.nombre as FK_Pais', 'turnos.nombre as FK_Turno',
                    'frecuencias.nombre as FK_Frecuencia')
                ->join('tipos', 'procesos.FK_Tipo', '=', 'tipos.id')
                ->join('grupos', 'procesos.FK_Grupo', '=', 'grupos.id')
                ->join('paises', 'grupos.FK_Pais', '=', 'paises.id')
                ->join('turnos', 'procesos.FK_Turno', '=', 'turnos.id')
                ->join('frecuencia_proceso', 'frecuencia_proceso.FK_Proceso', '=', 'procesos.id')
                ->join('frecuencias', 'frecuencia_proceso.FK_Frecuencia', '=', 'frecuencias.id')
                ->where('tipos.id','=',$tipoUsuario)
                ->where('procesos.estado', '=', 'Activo')
                ->where('procesos.semaforo', '=', 'Si')
                ->where(function ($query){
                    $query->where('frecuencia_proceso.dia', '=', 'Todos')
                        ->orWhere('frecuencia_proceso.dia', '=', Carbon::now()->day)
                        ->orWhere('frecuencia_proceso.dia', '=', ucfirst(Carbon::now()->formatLocalized('%A')));
                })
                ->get();
        }

        return view('Semaforo/listSemaforo', compact('procesosSemaforo'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $SLA = PSLA::find($id);
        return view('Semaforo/ModalJustificarSLA', compact('SLA'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $SLA = PSLA::find($request->id);
        $SLA ->justificacion_SLA = $request ->justificacion_SLA;
        $SLA -> save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
