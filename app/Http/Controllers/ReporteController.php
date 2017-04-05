<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proceso as Proceso;
use Illuminate\Support\Facades\DB;
use App\Models\Tipo as TipoR;
use App\Models\SLA as SLA;
use Carbon\Carbon;
use App\Models\Proceso_SLA as PSLA;
use App\Models\Turno as Turno;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $procesosSemaforoG= Proceso::orderBy('idP', 'ASC')
            ->select('procesos.id as idP','procesos.nombre','procesos.job','procesos.plataforma','procesos.servidor',
                'procesos.catalogo','tipos.nombre as responsable','grupos.nombre as grupo','paises.nombre as pais',
                'turnos.nombre as turno','proceso_sla.fecha as fecha','sla.porcentaje as porcentaje',
                DB::raw('addtime(procesos.Horario,procesos.t_ejecucion) as horaEntrega'))
            ->join('tipos','procesos.FK_Tipo','=','tipos.id')
            ->join('turnos','procesos.FK_Turno','=','turnos.id')
            ->join('grupos','procesos.FK_Grupo','=','grupos.id')
            ->join('paises','grupos.FK_Pais','=','paises.id')
            ->join('proceso_sla','proceso_sla.FK_Proceso','=','procesos.id')
            ->join('sla','proceso_sla.FK_SLA','=','sla.id')
            ->where('procesos.estado','=','Activo')
            ->where('procesos.semaforo','=','Si')
            ->get();


        $tipos= TipoR::orderBy('id','ASC')
            ->select('tipos.*')
            ->where('nombre','LIKE','%A1%')
            ->get();

        $turnos= Turno::orderBy('id','ASC')
            ->select('turnos.*')
            ->get();

        return view('Reportes/ProcesosEntregadosGeneral',compact('procesosSemaforoG','tipos','turnos'));
    }

    public function indexDiarios()
    {
        $procesosSemaforo= Proceso::orderBy('idP', 'ASC')
            ->select('procesos.id as idP','procesos.nombre','procesos.job','procesos.plataforma','procesos.servidor',
                'procesos.catalogo','tipos.nombre as responsable','grupos.nombre as grupo','paises.nombre as pais',
            'turnos.nombre as turno', DB::raw('addtime(procesos.Horario,procesos.t_ejecucion) as horaEntrega'))
            ->join('tipos','procesos.FK_Tipo','=','tipos.id')
            ->join('turnos','procesos.FK_Turno','=','turnos.id')
            ->join('grupos','procesos.FK_Grupo','=','grupos.id')
            ->join('paises','grupos.FK_Pais','=','paises.id')
            ->where('procesos.estado','=','Activo')
            ->where('procesos.semaforo','=','Si')
            ->get();


        $tipos= TipoR::orderBy('id','ASC')
            ->select('tipos.*')
            ->where('nombre','LIKE','%A1%')
            ->get();

        $turnos= Turno::orderBy('id','ASC')
            ->select('turnos.*')
            ->get();
        return view('Reportes/ProcesosEntregadosDiarios',compact('procesosSemaforo','tipos','turnos'));

    }


    public function filtroDiarios()
    {
        $procesosSemaforo= Proceso::orderBy('idP', 'ASC')
            ->select('procesos.id as idP','procesos.nombre','procesos.job','procesos.plataforma','procesos.servidor',
                'procesos.catalogo','tipos.nombre as responsable','grupos.nombre as grupo','paises.nombre as pais',
                'turnos.nombre as turno', DB::raw('addtime(procesos.Horario,procesos.t_ejecucion) as horaEntrega'))
            ->join('tipos','procesos.FK_Tipo','=','tipos.id')
            ->join('turnos','procesos.FK_Turno','=','turnos.id')
            ->join('grupos','procesos.FK_Grupo','=','grupos.id')
            ->join('paises','grupos.FK_Pais','=','paises.id')
            ->where('procesos.estado','=','Activo')
            ->where('procesos.semaforo','=','Si')
            ->get();
        $tipos= TipoR::orderBy('id','ASC')
            ->select('tipos.*')
            ->where('nombre','LIKE','%A1%')
            ->get();

        $turnos= Turno::orderBy('id','ASC')
            ->select('turnos.*')
            ->get();

        return view('Reportes/ProcesosEntregadosDiarios',compact('procesosSemaforo','tipos','turnos'));
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
        //
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
        //
    }

    public function search(Request $request)
    {

        if($request->searchResponsable!=null && $request->searchPlataforma==null && $request->searchTurno=="") {
            /*Consulta por responsable*/

            $procesosSemaforo= Proceso::orderBy('idP', 'ASC')
                ->select('procesos.id as idP','procesos.nombre','procesos.job','procesos.plataforma','procesos.servidor',
                    'procesos.catalogo','tipos.nombre as responsable','grupos.nombre as grupo','paises.nombre as pais',
                    'turnos.nombre as turno', DB::raw('addtime(procesos.Horario,procesos.t_ejecucion) as horaEntrega'))
                ->join('tipos','procesos.FK_Tipo','=','tipos.id')
                ->join('turnos','procesos.FK_Turno','=','turnos.id')
                ->join('grupos','procesos.FK_Grupo','=','grupos.id')
                ->join('paises','grupos.FK_Pais','=','paises.id')
                ->where('procesos.estado','=','Activo')
                ->where('procesos.semaforo','=','Si')
                ->where('tipos.id','=',$request->searchResponsable)
                ->get();
        }
        elseif ($request->searchPlataforma!="" && $request->searchResponsable=="" && $request->searchTurno==""){
            /*Consulta por plataforma*/
            $procesosSemaforo= Proceso::orderBy('idP', 'ASC')
                ->select('procesos.id as idP','procesos.nombre','procesos.job','procesos.plataforma','procesos.servidor',
                    'procesos.catalogo','tipos.nombre as responsable','grupos.nombre as grupo','paises.nombre as pais',
                    'turnos.nombre as turno', DB::raw('addtime(procesos.Horario,procesos.t_ejecucion) as horaEntrega'))
                ->join('tipos','procesos.FK_Tipo','=','tipos.id')
                ->join('turnos','procesos.FK_Turno','=','turnos.id')
                ->join('grupos','procesos.FK_Grupo','=','grupos.id')
                ->join('paises','grupos.FK_Pais','=','paises.id')
                ->where('procesos.estado','=','Activo')
                ->where('procesos.semaforo','=','Si')
                ->where('procesos.plataforma','=',$request->searchPlataforma)
                ->get();

        }
        elseif ($request->searchTurno!="" && $request->searchResponsable=="" && $request->searchPlataforma==""){
            /*Consulta por turno*/
            $procesosSemaforo= Proceso::orderBy('idP', 'ASC')
                ->select('procesos.id as idP','procesos.nombre','procesos.job','procesos.plataforma','procesos.servidor',
                    'procesos.catalogo','tipos.nombre as responsable','grupos.nombre as grupo','paises.nombre as pais',
                    'turnos.nombre as turno', DB::raw('addtime(procesos.Horario,procesos.t_ejecucion) as horaEntrega'))
                ->join('tipos','procesos.FK_Tipo','=','tipos.id')
                ->join('turnos','procesos.FK_Turno','=','turnos.id')
                ->join('grupos','procesos.FK_Grupo','=','grupos.id')
                ->join('paises','grupos.FK_Pais','=','paises.id')
                ->where('procesos.estado','=','Activo')
                ->where('procesos.semaforo','=','Si')
                ->where('turnos.id','=',$request->searchTurno)
                ->get();
        }
        elseif($request->searchResponsable!=null && $request->searchPlataforma!=null && $request->searchTurno=="") {
            /*Consulta por responsable y plataforma*/

            $procesosSemaforo= Proceso::orderBy('idP', 'ASC')
                ->select('procesos.id as idP','procesos.nombre','procesos.job','procesos.plataforma','procesos.servidor',
                    'procesos.catalogo','tipos.nombre as responsable','grupos.nombre as grupo','paises.nombre as pais',
                    'turnos.nombre as turno', DB::raw('addtime(procesos.Horario,procesos.t_ejecucion) as horaEntrega'))
                ->join('tipos','procesos.FK_Tipo','=','tipos.id')
                ->join('turnos','procesos.FK_Turno','=','turnos.id')
                ->join('grupos','procesos.FK_Grupo','=','grupos.id')
                ->join('paises','grupos.FK_Pais','=','paises.id')
                ->where('procesos.estado','=','Activo')
                ->where('procesos.semaforo','=','Si')
                ->where('tipos.id','=',$request->searchResponsable)
                ->where('procesos.plataforma','=',$request->searchPlataforma)
                ->get();
        }

        elseif($request->searchResponsable!="" && $request->searchPlataforma=="" && $request->searchTurno!="") {
            /*Consulta por responsable y turno*/

            $procesosSemaforo= Proceso::orderBy('idP', 'ASC')
                ->select('procesos.id as idP','procesos.nombre','procesos.job','procesos.plataforma','procesos.servidor',
                    'procesos.catalogo','tipos.nombre as responsable','grupos.nombre as grupo','paises.nombre as pais',
                    'turnos.nombre as turno', DB::raw('addtime(procesos.Horario,procesos.t_ejecucion) as horaEntrega'))
                ->join('tipos','procesos.FK_Tipo','=','tipos.id')
                ->join('turnos','procesos.FK_Turno','=','turnos.id')
                ->join('grupos','procesos.FK_Grupo','=','grupos.id')
                ->join('paises','grupos.FK_Pais','=','paises.id')
                ->where('procesos.estado','=','Activo')
                ->where('procesos.semaforo','=','Si')
                ->where('tipos.id','=',$request->searchResponsable)
                ->where('turnos.id','=',$request->searchTurno)
                ->get();
        }

        elseif($request->searchPlataforma!="" && $request->searchResponsable=="" && $request->searchTurno!="") {
            /*Consulta por plataforma y turno*/

            $procesosSemaforo= Proceso::orderBy('idP', 'ASC')
                ->select('procesos.id as idP','procesos.nombre','procesos.job','procesos.plataforma','procesos.servidor',
                    'procesos.catalogo','tipos.nombre as responsable','grupos.nombre as grupo','paises.nombre as pais',
                    'turnos.nombre as turno', DB::raw('addtime(procesos.Horario,procesos.t_ejecucion) as horaEntrega'))
                ->join('tipos','procesos.FK_Tipo','=','tipos.id')
                ->join('turnos','procesos.FK_Turno','=','turnos.id')
                ->join('grupos','procesos.FK_Grupo','=','grupos.id')
                ->join('paises','grupos.FK_Pais','=','paises.id')
                ->where('procesos.estado','=','Activo')
                ->where('procesos.semaforo','=','Si')
                ->where('procesos.plataforma','=',$request->searchPlataforma)
                ->where('turnos.id','=',$request->searchTurno)
                ->get();
        }

        elseif($request->searchResponsable!="" && $request->searchPlataforma!="" && $request->searchTurno!="") {
            /*Consulta por responsable plataforma y turno*/

            $procesosSemaforo= Proceso::orderBy('idP', 'ASC')
                ->select('procesos.id as idP','procesos.nombre','procesos.job','procesos.plataforma','procesos.servidor',
                    'procesos.catalogo','tipos.nombre as responsable','grupos.nombre as grupo','paises.nombre as pais',
                    'turnos.nombre as turno', DB::raw('addtime(procesos.Horario,procesos.t_ejecucion) as horaEntrega'))
                ->join('tipos','procesos.FK_Tipo','=','tipos.id')
                ->join('turnos','procesos.FK_Turno','=','turnos.id')
                ->join('grupos','procesos.FK_Grupo','=','grupos.id')
                ->join('paises','grupos.FK_Pais','=','paises.id')
                ->where('procesos.estado','=','Activo')
                ->where('procesos.semaforo','=','Si')
                ->where('tipos.id','=',$request->searchResponsable)
                ->where('procesos.plataforma','=',$request->searchPlataforma)
                ->where('turnos.id','=',$request->searchTurno)
                ->get();
        }


        $tipos= TipoR::orderBy('id','ASC')
            ->select('tipos.*')
            ->where('nombre','LIKE','%A1%')
            ->get();

        $turnos= Turno::orderBy('id','ASC')
            ->select('turnos.*')
            ->get();

        return view('Reportes/ProcesosEntregadosDiarios',compact('procesosSemaforo','tipos','turnos'));

    }

    public function searchGeneral(Request $request)
    {




        /*consulta fecha inicio y fecha fin y responsable*/

        if($request->searchFechaProcesoI!=null && $request->searchFechaProcesoF!=null && $request->searchResponsable=="" && $request->searchPlataforma=="") {
            /*consulta fecha inicio y fecha fin*/

            $procesosSemaforoG= Proceso::orderBy('idP', 'ASC')
                ->select('procesos.id as idP','procesos.nombre','procesos.job','procesos.plataforma','procesos.servidor',
                    'procesos.catalogo','tipos.nombre as responsable','grupos.nombre as grupo','paises.nombre as pais',
                    'turnos.nombre as turno','proceso_sla.fecha as fecha','sla.porcentaje as porcentaje',
                    DB::raw('addtime(procesos.Horario,procesos.t_ejecucion) as horaEntrega'))
                ->join('tipos','procesos.FK_Tipo','=','tipos.id')
                ->join('turnos','procesos.FK_Turno','=','turnos.id')
                ->join('grupos','procesos.FK_Grupo','=','grupos.id')
                ->join('paises','grupos.FK_Pais','=','paises.id')
                ->join('proceso_sla','proceso_sla.FK_Proceso','=','procesos.id')
                ->join('sla','proceso_sla.FK_SLA','=','sla.id')
                ->where('procesos.estado','=','Activo')
                ->where('procesos.semaforo','=','Si')
                ->whereBetween('proceso_sla.fecha', [$request->searchFechaProcesoI, $request->searchFechaProcesoF])
                ->get();
        }
        elseif ($request->searchFechaProcesoI!=null && $request->searchFechaProcesoF!=null && $request->searchResponsable=="" && $request->searchPlataforma!=""){
            /*consulta fecha inicio y fecha fin y plataforma*/

            $procesosSemaforoG= Proceso::orderBy('idP', 'ASC')
                ->select('procesos.id as idP','procesos.nombre','procesos.job','procesos.plataforma','procesos.servidor',
                    'procesos.catalogo','tipos.nombre as responsable','grupos.nombre as grupo','paises.nombre as pais',
                    'turnos.nombre as turno','proceso_sla.fecha as fecha','sla.porcentaje as porcentaje',
                    DB::raw('addtime(procesos.Horario,procesos.t_ejecucion) as horaEntrega'))
                ->join('tipos','procesos.FK_Tipo','=','tipos.id')
                ->join('turnos','procesos.FK_Turno','=','turnos.id')
                ->join('grupos','procesos.FK_Grupo','=','grupos.id')
                ->join('paises','grupos.FK_Pais','=','paises.id')
                ->join('proceso_sla','proceso_sla.FK_Proceso','=','procesos.id')
                ->join('sla','proceso_sla.FK_SLA','=','sla.id')
                ->where('procesos.estado','=','Activo')
                ->where('procesos.semaforo','=','Si')
                ->where('procesos.plataforma','=', $request->searchPlataforma)
                ->whereBetween('proceso_sla.fecha', [$request->searchFechaProcesoI, $request->searchFechaProcesoF])
                ->get();

        }
        elseif ($request->searchFechaProcesoI!=null && $request->searchFechaProcesoF!=null && $request->searchResponsable!="" && $request->searchPlataforma==""){
            /*consulta fecha inicio y fecha fin y responsable*/

            $procesosSemaforoG= Proceso::orderBy('idP', 'ASC')
                ->select('procesos.id as idP','procesos.nombre','procesos.job','procesos.plataforma','procesos.servidor',
                    'procesos.catalogo','tipos.nombre as responsable','grupos.nombre as grupo','paises.nombre as pais',
                    'turnos.nombre as turno','proceso_sla.fecha as fecha','sla.porcentaje as porcentaje',
                    DB::raw('addtime(procesos.Horario,procesos.t_ejecucion) as horaEntrega'))
                ->join('tipos','procesos.FK_Tipo','=','tipos.id')
                ->join('turnos','procesos.FK_Turno','=','turnos.id')
                ->join('grupos','procesos.FK_Grupo','=','grupos.id')
                ->join('paises','grupos.FK_Pais','=','paises.id')
                ->join('proceso_sla','proceso_sla.FK_Proceso','=','procesos.id')
                ->join('sla','proceso_sla.FK_SLA','=','sla.id')
                ->where('procesos.estado','=','Activo')
                ->where('procesos.semaforo','=','Si')
                ->where('tipos.id','=', $request->searchResponsable)
                ->whereBetween('proceso_sla.fecha', [$request->searchFechaProcesoI, $request->searchFechaProcesoF])
                ->get();

        }

        elseif ($request->searchFechaProcesoI!=null && $request->searchFechaProcesoF!=null && $request->searchResponsable!="" && $request->searchPlataforma!=""){
            /*consulta fecha inicio y fecha fin y responsable*/

            $procesosSemaforoG= Proceso::orderBy('idP', 'ASC')
                ->select('procesos.id as idP','procesos.nombre','procesos.job','procesos.plataforma','procesos.servidor',
                    'procesos.catalogo','tipos.nombre as responsable','grupos.nombre as grupo','paises.nombre as pais',
                    'turnos.nombre as turno','proceso_sla.fecha as fecha','sla.porcentaje as porcentaje',
                    DB::raw('addtime(procesos.Horario,procesos.t_ejecucion) as horaEntrega'))
                ->join('tipos','procesos.FK_Tipo','=','tipos.id')
                ->join('turnos','procesos.FK_Turno','=','turnos.id')
                ->join('grupos','procesos.FK_Grupo','=','grupos.id')
                ->join('paises','grupos.FK_Pais','=','paises.id')
                ->join('proceso_sla','proceso_sla.FK_Proceso','=','procesos.id')
                ->join('sla','proceso_sla.FK_SLA','=','sla.id')
                ->where('procesos.estado','=','Activo')
                ->where('procesos.semaforo','=','Si')
                ->where('procesos.plataforma','=', $request->searchPlataforma)
                ->where('tipos.id','=', $request->searchResponsable)
                ->whereBetween('proceso_sla.fecha', [$request->searchFechaProcesoI, $request->searchFechaProcesoF])
                ->get();

        }


        $tipos= TipoR::orderBy('id','ASC')
            ->select('tipos.*')
            ->where('nombre','LIKE','%A1%')
            ->get();

        $turnos= Turno::orderBy('id','ASC')
            ->select('turnos.*')
            ->get();

        return view('Reportes/ProcesosEntregadosGeneral',compact('procesosSemaforoG','tipos','turnos'));

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
