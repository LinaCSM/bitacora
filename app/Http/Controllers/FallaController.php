<?php

namespace App\Http\Controllers;

use App\Models\Entregas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Falla as Falla;
use App\Models\Proceso as Proceso;
use App\Models\Entregas as Entrega;
use App\Models\Proceso_Falla as PFalla;
use Illuminate\Support\Facades\Session;

class FallaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoUsuario = \Auth::user()->FK_Tipo;

        if (Carbon::now()->toTimeString() >= '22:00:00' && Carbon::now()->toTimeString() <= '23:59:59') {

            if($tipoUsuario=="1" || $tipoUsuario=="2" || $tipoUsuario=="7"){
                $fallas = Falla::orderBy('fecha', 'ASC')
                    ->select('procesos.id as Pid', 'procesos.job', 'procesos.nombre', 'procesos.plataforma', 'frecuencias.nombre as FK_Frecuencia',
                         'tipos.nombre as FK_Tipo', 'fallas.*', 'entregas.registro',
                        'turnos.nombre as FK_Turno', 'entregas.id as idE')
                    ->join('procesos', 'fallas.FK_Proceso', '=', 'procesos.id')
                    ->join('tipos', 'procesos.FK_Tipo', '=', 'tipos.id')
                    ->join('turnos', 'procesos.FK_Turno', '=', 'turnos.id')
                    ->join('frecuencia_proceso', 'frecuencia_proceso.FK_Proceso', '=', 'procesos.id')
                    ->join('frecuencias', 'frecuencia_proceso.FK_Frecuencia', '=', 'frecuencias.id')
                    ->join('asignacion', 'asignacion.FK_Proceso', '=', 'procesos.id')
                    ->join('entregas', 'entregas.FK_Asignacion', '=', 'asignacion.id')
                    ->where('fallas.fecha', '=', Carbon::now()->toDateString())
                    ->where('entregas.fecha', '=', Carbon::now()->toDateString())
                    ->get();
            }else{
                $fallas = Falla::orderBy('fecha', 'ASC')
                    ->select('procesos.id as Pid', 'procesos.job', 'procesos.nombre', 'procesos.plataforma', 'frecuencias.nombre as FK_Frecuencia',
                         'tipos.nombre as FK_Tipo', 'fallas.*', 'entregas.registro',
                        'turnos.nombre as FK_Turno', 'entregas.id as idE')
                    ->join('procesos', 'fallas.FK_Proceso', '=', 'procesos.id')
                    ->join('tipos', 'procesos.FK_Tipo', '=', 'tipos.id')
                    ->join('turnos', 'procesos.FK_Turno', '=', 'turnos.id')
                    ->join('frecuencia_proceso', 'frecuencia_proceso.FK_Proceso', '=', 'procesos.id')
                    ->join('frecuencias', 'frecuencia_proceso.FK_Frecuencia', '=', 'frecuencias.id')
                    ->join('asignacion', 'asignacion.FK_Proceso', '=', 'procesos.id')
                    ->join('entregas', 'entregas.FK_Asignacion', '=', 'asignacion.id')
                    ->where('tipos.id','=',$tipoUsuario)
                    ->where('fallas.fecha', '=', Carbon::now()->toDateString())
                    ->where('entregas.fecha', '=', Carbon::now()->toDateString())
                    ->get();
            }
        }

        if (Carbon::now()->toTimeString() >= '00:00:00' && Carbon::now()->toTimeString() <= '21:59:59') {

            if($tipoUsuario=="1" || $tipoUsuario=="2" || $tipoUsuario=="7"){
                $fallasDiarias = Falla::orderBy('fecha', 'ASC')
                    ->select('procesos.id as Pid', 'procesos.job', 'procesos.nombre', 'procesos.plataforma', 'frecuencias.nombre as FK_Frecuencia',
                         'tipos.nombre as FK_Tipo', 'fallas.*', 'entregas.registro',
                        'turnos.nombre as FK_Turno', 'entregas.id as idE')
                    ->join('procesos', 'fallas.FK_Proceso', '=', 'procesos.id')
                    ->join('tipos', 'procesos.FK_Tipo', '=', 'tipos.id')
                    ->join('turnos', 'procesos.FK_Turno', '=', 'turnos.id')
                    ->join('frecuencia_proceso', 'frecuencia_proceso.FK_Proceso', '=', 'procesos.id')
                    ->join('frecuencias', 'frecuencia_proceso.FK_Frecuencia', '=', 'frecuencias.id')
                    ->join('asignacion', 'asignacion.FK_Proceso', '=', 'procesos.id')
                    ->join('entregas', 'entregas.FK_Asignacion', '=', 'asignacion.id')
                    ->where('turnos.nombre', '!=', 'Noche')
                    ->where('fallas.fecha', '=', Carbon::now()->toDateString())
                    ->where('entregas.fecha', '=', Carbon::now()->toDateString());

                $fallas = Falla::orderBy('fecha', 'ASC')
                    ->select('procesos.id as Pid', 'procesos.job', 'procesos.nombre', 'procesos.plataforma', 'frecuencias.nombre as FK_Frecuencia',
                         'tipos.nombre as FK_Tipo', 'fallas.*', 'entregas.registro',
                        'turnos.nombre as FK_Turno', 'entregas.id as idE')
                    ->join('procesos', 'fallas.FK_Proceso', '=', 'procesos.id')
                    ->join('tipos', 'procesos.FK_Tipo', '=', 'tipos.id')
                    ->join('turnos', 'procesos.FK_Turno', '=', 'turnos.id')
                    ->join('frecuencia_proceso', 'frecuencia_proceso.FK_Proceso', '=', 'procesos.id')
                    ->join('frecuencias', 'frecuencia_proceso.FK_Frecuencia', '=', 'frecuencias.id')
                    ->join('asignacion', 'asignacion.FK_Proceso', '=', 'procesos.id')
                    ->join('entregas', 'entregas.FK_Asignacion', '=', 'asignacion.id')
                    ->where('turnos.nombre', '=', 'Noche')
                    ->where('fallas.fecha', '=', Carbon::yesterday()->toDateString())
                    ->where('entregas.fecha', '=', Carbon::yesterday()->toDateString())
                    ->union($fallasDiarias)
                    ->get();
            }else{
                $fallasDiarias = Falla::orderBy('fecha', 'ASC')
                    ->select('procesos.id as Pid', 'procesos.job', 'procesos.nombre', 'procesos.plataforma', 'frecuencias.nombre as FK_Frecuencia',
                        'frecuencia_proceso.dia as DiaEjecucion', 'tipos.nombre as FK_Tipo', 'fallas.*', 'entregas.registro',
                        'turnos.nombre as FK_Turno', 'entregas.id as idE')
                    ->join('procesos', 'fallas.FK_Proceso', '=', 'procesos.id')
                    ->join('tipos', 'procesos.FK_Tipo', '=', 'tipos.id')
                    ->join('turnos', 'procesos.FK_Turno', '=', 'turnos.id')
                    ->join('frecuencia_proceso', 'frecuencia_proceso.FK_Proceso', '=', 'procesos.id')
                    ->join('frecuencias', 'frecuencia_proceso.FK_Frecuencia', '=', 'frecuencias.id')
                    ->join('asignacion', 'asignacion.FK_Proceso', '=', 'procesos.id')
                    ->join('entregas', 'entregas.FK_Asignacion', '=', 'asignacion.id')
                    ->where('tipos.id','=',$tipoUsuario)
                    ->where('turnos.nombre', '!=', 'Noche')
                    ->where('fallas.fecha', '=', Carbon::now()->toDateString())
                    ->where('entregas.fecha', '=', Carbon::now()->toDateString());

                $fallas = Falla::orderBy('fecha', 'ASC')
                    ->select('procesos.id as Pid', 'procesos.job', 'procesos.nombre', 'procesos.plataforma', 'frecuencias.nombre as FK_Frecuencia',
                        'frecuencia_proceso.dia as DiaEjecucion', 'tipos.nombre as FK_Tipo', 'fallas.*', 'entregas.registro',
                        'turnos.nombre as FK_Turno', 'entregas.id as idE')
                    ->join('procesos', 'fallas.FK_Proceso', '=', 'procesos.id')
                    ->join('tipos', 'procesos.FK_Tipo', '=', 'tipos.id')
                    ->join('turnos', 'procesos.FK_Turno', '=', 'turnos.id')
                    ->join('frecuencia_proceso', 'frecuencia_proceso.FK_Proceso', '=', 'procesos.id')
                    ->join('frecuencias', 'frecuencia_proceso.FK_Frecuencia', '=', 'frecuencias.id')
                    ->join('asignacion', 'asignacion.FK_Proceso', '=', 'procesos.id')
                    ->join('entregas', 'entregas.FK_Asignacion', '=', 'asignacion.id')
                    ->where('tipos.id','=',$tipoUsuario)
                    ->where('turnos.nombre', '=', 'Noche')
                    ->where('fallas.fecha', '=', Carbon::yesterday()->toDateString())
                    ->where('entregas.fecha', '=', Carbon::yesterday()->toDateString())
                    ->union($fallasDiarias)
                    ->get();
            }
        }
        return view('Fallas/FallasDiarias', compact('fallas'));
    }

    public function indexMensual()
    {
        $tipoUsuario = \Auth::user()->FK_Tipo;

        if($tipoUsuario=="1" || $tipoUsuario=="2" || $tipoUsuario=="7"){
            $fallas = PFalla::orderBy('fecha', 'ASC')
                ->select('fallas.*','procesos.id as idP', 'procesos.nombre', 'procesos.plataforma', 'procesos.job',
                    'fallas.solucion', 'fallas.r_proceso', 'fallas.estado', 'tipos.nombre as FK_Tipo','frecuencia_proceso.dia as DiaEjecucion',
                    'frecuencias.nombre as FK_Frecuencia','proceso_falla.fecha as fechaPF','turnos.nombre as FK_Turno')
                ->join('fallas', 'proceso_falla.FK_Falla', '=', 'fallas.id')
                ->join('procesos', 'fallas.FK_Proceso', '=', 'procesos.id')
                ->join('frecuencia_proceso', 'frecuencia_proceso.FK_Proceso', '=', 'procesos.id')
                ->join('frecuencias', 'frecuencia_proceso.FK_Frecuencia', '=', 'frecuencias.id')
                ->join('tipos', 'procesos.FK_Tipo', '=', 'tipos.id')
                ->join('turnos', 'procesos.FK_Turno', '=', 'turnos.id')
                ->whereBetween('proceso_falla.fecha', [Carbon::now()->startOfMonth()->toDateString(), Carbon::now()->endOfMonth()->toDateString()])
                ->get();
        }else{
            $fallas = PFalla::orderBy('fecha', 'ASC')
                ->select('fallas.*','procesos.id as idP', 'procesos.nombre', 'procesos.plataforma', 'procesos.job',
                    'fallas.solucion', 'fallas.r_proceso', 'fallas.estado', 'tipos.nombre as FK_Tipo','frecuencia_proceso.dia as DiaEjecucion',
                    'frecuencias.nombre as FK_Frecuencia','proceso_falla.fecha as fechaPF','turnos.nombre as FK_Turno')
                ->join('fallas', 'proceso_falla.FK_Falla', '=', 'fallas.id')
                ->join('procesos', 'fallas.FK_Proceso', '=', 'procesos.id')
                ->join('frecuencia_proceso', 'frecuencia_proceso.FK_Proceso', '=', 'procesos.id')
                ->join('frecuencias', 'frecuencia_proceso.FK_Frecuencia', '=', 'frecuencias.id')
                ->join('tipos', 'procesos.FK_Tipo', '=', 'tipos.id')
                ->join('turnos', 'procesos.FK_Turno', '=', 'turnos.id')
                ->where('tipos.id','=',$tipoUsuario)
                ->whereBetween('proceso_falla.fecha', [Carbon::now()->startOfMonth()->toDateString(), Carbon::now()->endOfMonth()->toDateString()])
                ->get();
        }

        return view('Fallas/FallasMensuales', compact('fallas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public static function buscarEntregaFalla($idProceso,$fecha)
    {

        $entrega = Proceso::find($idProceso)
            ->select('procesos.id', 'entregas.registro')
            ->join('asignacion', 'asignacion.FK_Proceso', '=', 'procesos.id')
            ->join('entregas', 'entregas.FK_Asignacion', '=', 'asignacion.id')
            ->where('asignacion.FK_Proceso', '=', $idProceso)
            ->where('entregas.fecha','=',$fecha)
            ->get();

        return $entrega;
    }



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
        if($request->ajax()){

            if($request->turno=="Noche"){

                $falla = Falla::orderBy('created_at', 'DESC')
                    ->select('fallas.*')
                    ->join('procesos','fallas.FK_Proceso', '=', 'procesos.id')
                    ->where('fallas.FK_Proceso', '=', $request->idProceso)
                    ->where('fallas.fecha', '=', $request->fecha)
                    ->get();

                if($falla=="[]"){
                    $FallaProceso = new Falla();
                    $FallaProceso->fecha = $request->fecha;
                    $FallaProceso->n_caso = $request->n_caso;
                    $FallaProceso->descripcion = $request->descripcion;
                    $FallaProceso->estado = $request->estado;
                    $FallaProceso->tipo = $request->tipo;
                    $FallaProceso->solucion = $request->solucion;
                    $FallaProceso->FK_Proceso = $request->idProceso;
                    $FallaProceso->save();
                }

            }else{

                $falla = Falla::orderBy('created_at', 'DESC')
                    ->select('fallas.*')
                    ->join('procesos','fallas.FK_Proceso', '=', 'procesos.id')
                    ->where('fallas.FK_Proceso', '=', $request->idProceso)
                    ->where('fallas.fecha', '=',  $request->fecha)
                    ->get();

                if($falla=="[]"){
                        $FallaProceso = new Falla();
                        $FallaProceso->fecha = $request->fecha;
                        $FallaProceso->n_caso = $request->n_caso;
                        $FallaProceso->descripcion = $request->descripcion;
                        $FallaProceso->estado = $request->estado;
                        $FallaProceso->tipo = $request->tipo;
                        $FallaProceso->solucion = $request->solucion;
                        $FallaProceso->FK_Proceso = $request->idProceso;
                        $FallaProceso->save();
                }
            }

        }

        return redirect()->back();
    }
    
    

    public static function buscarFallaNoche($id)
    {

        $fallaP = Proceso::find($id)
            ->select('fallas.*','entregas.registro')
            ->join('fallas','fallas.FK_Proceso','=','procesos.id')
            ->join('asignacion', 'asignacion.FK_Proceso', '=', 'procesos.id')
            ->join('entregas', 'entregas.FK_Asignacion', '=', 'asignacion.id')
            ->where('fallas.FK_Proceso', '=', $id)
            ->where('fallas.fecha','=',Carbon::yesterday()->toDateString())
            ->where('entregas.fecha','=',Carbon::yesterday()->toDateString())
            ->get();

        return $fallaP;
    }

    public static function buscarFalla($id)
    {

        $fallaP = Proceso::find($id)
            ->select('fallas.*','entregas.registro')
            ->join('fallas','fallas.FK_Proceso','=','procesos.id')
            ->join('asignacion', 'asignacion.FK_Proceso', '=', 'procesos.id')
            ->join('entregas', 'entregas.FK_Asignacion', '=', 'asignacion.id')
            ->where('fallas.FK_Proceso', '=', $id)
            ->where('fallas.fecha','=',Carbon::now()->toDateString())
            ->where('entregas.fecha','=',Carbon::now()->toDateString())
            ->get();

        return $fallaP;
    }



    public static function registroProcesoFalla($id)
    {
        $FallaP = Proceso::find($id)
            ->select('procesos.id as proceso_id','fallas.id as falla_id')
            ->join('fallas', 'fallas.FK_Proceso', '=', 'procesos.id')
            ->where('fallas.FK_Proceso', '=', $id)
            ->where('fallas.fecha','=',Carbon::now()->toDateString())
            ->get();

        foreach ($FallaP as $falla){
            $pFalla = PFalla::orderBy('created_at', 'DESC')
                ->select('procesos.id', 'fallas.id','proceso_falla.*')
                ->join('fallas','proceso_falla.FK_Falla', '=', 'fallas.id')
                ->join('procesos','proceso_falla.FK_Proceso', '=', 'procesos.id')
                ->where('proceso_falla.FK_Falla', '=', $falla->falla_id)
                ->where('proceso_falla.FK_Proceso', '=', $falla->proceso_id)
                ->where('proceso_falla.fecha','=',Carbon::now()->toDateString())
                ->get();

            if($pFalla=='[]'){
                $ProcesoFalla = new PFalla();
                $ProcesoFalla->fecha = Carbon::now()->toDateString();
                $ProcesoFalla->FK_Falla = $falla->falla_id;
                $ProcesoFalla->FK_Proceso = $falla->proceso_id;
                $ProcesoFalla->save();
            }
        }
    }


    public static function registroProcesoFallaNoche($id)
    {
        if(Carbon::now()->toTimeString()>='22:00:00' && Carbon::now()->toTimeString()<='23:59:59') {
            $FallaP = Proceso::find($id)
                ->select('procesos.id as proceso_id', 'fallas.id as falla_id')
                ->join('fallas', 'fallas.FK_Proceso', '=', 'procesos.id')
                ->where('fallas.FK_Proceso', '=', $id)
                ->where('fallas.fecha', '=', Carbon::now()->toDateString())
                ->get();

            foreach ($FallaP as $falla) {
                $pFalla = PFalla::orderBy('created_at', 'DESC')
                    ->select('procesos.id', 'fallas.id', 'proceso_falla.*')
                    ->join('fallas', 'proceso_falla.FK_Falla', '=', 'fallas.id')
                    ->join('procesos', 'proceso_falla.FK_Proceso', '=', 'procesos.id')
                    ->where('proceso_falla.FK_Falla', '=', $falla->falla_id)
                    ->where('proceso_falla.FK_Proceso', '=', $falla->proceso_id)
                    ->where('proceso_falla.fecha', '=', Carbon::now()->toDateString())
                    ->get();

                if ($pFalla == '[]') {
                    $ProcesoFalla = new PFalla();
                    $ProcesoFalla->fecha = Carbon::now()->toDateString();
                    $ProcesoFalla->FK_Falla = $falla->falla_id;
                    $ProcesoFalla->FK_Proceso = $falla->proceso_id;
                    $ProcesoFalla->save();
                }
            }
        }

        if(Carbon::now()->toTimeString()>='00:00:00' && Carbon::now()->toTimeString()<='21:59:59') {

            $FallaP = Proceso::find($id)
                ->select('procesos.id as proceso_id', 'fallas.id as falla_id')
                ->join('fallas', 'fallas.FK_Proceso', '=', 'procesos.id')
                ->where('fallas.FK_Proceso', '=', $id)
                ->where('fallas.fecha', '=', Carbon::yesterday()->toDateString())
                ->get();

            foreach ($FallaP as $falla) {
                $pFalla = PFalla::orderBy('created_at', 'DESC')
                    ->select('procesos.id', 'fallas.id', 'proceso_falla.*')
                    ->join('fallas', 'proceso_falla.FK_Falla', '=', 'fallas.id')
                    ->join('procesos', 'proceso_falla.FK_Proceso', '=', 'procesos.id')
                    ->where('proceso_falla.FK_Falla', '=', $falla->falla_id)
                    ->where('proceso_falla.FK_Proceso', '=', $falla->proceso_id)
                    ->where('proceso_falla.fecha', '=', Carbon::yesterday()->toDateString())
                    ->get();

                if ($pFalla == '[]') {
                    $ProcesoFalla = new PFalla();
                    $ProcesoFalla->fecha = Carbon::yesterday()->toDateString();
                    $ProcesoFalla->FK_Falla = $falla->falla_id;
                    $ProcesoFalla->FK_Proceso = $falla->proceso_id;
                    $ProcesoFalla->save();
                }
            }
        }
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
        $Falla = Falla::find($id);
        return view('Falla/UpdateFalla', compact('Falla'));
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
        $Falla = Falla::find($request->id);
        $Falla ->n_caso = $request ->n_caso;
        $Falla ->descripcion = $request ->descripcion;
        $Falla ->tipo = $request ->tipo;
        $Falla ->solucion = $request ->solucion;
        $Falla ->r_proceso = $request ->r_proceso;
        if($Falla ->r_proceso=="Si"){

            $Entrega = Entrega::find($request->idE)
                ->select('entregas.*')
                ->get();

            foreach ($Entrega as $PEntrega){
                if($PEntrega->estado!="Exitoso"){
                    $Entrega = Entrega::find($PEntrega->id);
                    $Entrega ->fecha = $PEntrega->fecha;
                    $Entrega ->registro = $PEntrega->registro;
                    $Entrega ->estado = "Exitoso";
                    $Entrega ->justificacion = $PEntrega->justificacion;
                    $Entrega -> save();
                }
            }
        }
        if($Falla ->r_proceso=="No"){

            $Entrega = Entrega::find($request->idE)
                ->select('entregas.*')
                ->get();

            foreach ($Entrega as $PEntrega){
                if($PEntrega->estado!="Fallido"){
                    $Entrega = Entrega::find($PEntrega->id);
                    $Entrega ->fecha = $PEntrega->fecha;
                    $Entrega ->registro = $PEntrega->registro;
                    $Entrega ->estado = "Fallido";
                    $Entrega ->justificacion = $PEntrega->justificacion;
                    $Entrega -> save();
                }
            }
        }
        $Falla -> save();
        return redirect()->back();
    }



    public function actualizarEstado(Request $request)
    {
        if($request->ajax()) {
            $Fallas = Falla::find($request->idFallaU);
            $Fallas->estado = $request->estadoU;
            $Fallas->solucion = $request->solucionU;
            $Fallas->save();
        }

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
        $Falla=Falla::findOrFail($id);
        $Falla->delete();
        return redirect()->back();
    }
}
