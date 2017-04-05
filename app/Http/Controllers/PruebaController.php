<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Proceso as Proceso;
use App\Models\Frecuencia as Frecuencia;
use App\Models\Frecuencia_Proceso as FrecuenciaP;
use App\Models\Asignacion as Asignacion;
use App\Models\Grupo as Grupo;
use App\Models\Pais as Pais;
use App\Models\Tipo as TipoR;
use App\Models\Turno as Turno;

use Illuminate\Http\Request;

class PruebaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $procesos=Proceso::orderBy('created_at','DESC')
            ->select('procesos.*', 'grupos.id','grupos.FK_Pais','turnos.id','tipos.id'
                ,'frecuencia_proceso.FK_Frecuencia','frecuencias.id','frecuencia_proceso.dia','paises.id','asignacion.FK_Proceso')
            ->join('turnos','procesos.FK_Turno','=','turnos.id')
            ->join('tipos','procesos.FK_Tipo','=','tipos.id')
            ->join('frecuencia_proceso','frecuencia_proceso.FK_Proceso','=','procesos.id')
            ->join('frecuencias','frecuencia_proceso.FK_Frecuencia','=','frecuencias.id')
            ->join('asignacion','procesos.id','=','asignacion.FK_Proceso')
            ->join('grupos','procesos.FK_Grupo','=','grupos.id')
            ->join('paises','grupos.FK_Pais','=','paises.id')->get();


        $tipos= TipoR::orderBy('id','ASC')
            ->select('tipos.*')
            ->where('nombre','LIKE','%A1%')
            ->pluck('nombre','id');

        $frecuencias = Frecuencia::pluck('nombre','id');

        $diaFrecuencia = FrecuenciaP::pluck('dia','id');

        $grupos = Grupo::pluck('nombre','id');

        $paises = Pais::pluck('nombre','id');

        $turnos = Turno::pluck('nombre','id');

        return \View::make('Pruebas/listPrueba', compact('procesos','tipos','frecuencias','diaFrecuencia','grupos','paises','turnos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('Procesos/NewProceso');
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
        $Proceso= Proceso::findOrFail($id);
        return view('Proceso.edit');
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
        $Proceso = Proceso::findOrFail($id);

        $Proceso ->nombre = $request ->nombre;
        $Proceso ->job = $request ->job;
        $Proceso ->tarea_programada = $request ->tarea_programada;
        $Proceso ->prerequisitos = $request ->prerequisitos;
        $Proceso ->catalogo = $request ->catalogo;
        $Proceso ->FK_Turno = $request ->FK_Turno;
        $Proceso ->horario = $request ->horario;
        $Proceso ->t_ejecucion = $request ->t_ejecucion;
        $Proceso ->FK_Grupo = $request ->FK_Grupo;
        $Proceso ->sysdate = $request ->sysdate;
        $Proceso ->servidor = $request ->servidor;
        $Proceso ->semaforo = $request ->semaforo;
        $Proceso ->plataforma = $request ->plataforma;
        $Proceso ->FK_Tipo = $request ->FK_Tipo;
        $Proceso -> save();



        /*$Frecuencia = FrecuenciaP::find('FK_Proceso',$id);
        $Frecuencia ->FK_Frecuencia = $request ->FK_Frecuencia;
        $Frecuencia ->dia = $request ->dia;
        $Frecuencia -> save();*/



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

    }
    public function search(Request $request)
    {

    }
}