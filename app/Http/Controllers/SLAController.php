<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proceso_SLA as PSLA;
use App\Models\SLA as SLA;
use Carbon\Carbon;

class SLAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sla=SLA::orderby('id','asc')
            ->select('sla.*')
            ->get();
        return view('SLA/listSLA', compact('sla'));
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
        if($request->ajax()){

            $sla=SLA::orderBy('created_at','DESC')
                ->select('sla.*')
                ->where('sla.porcentaje', '=', $request ->porcentaje)
                ->get();

            if($sla=="[]"){
                $SLA = new SLA();
                $SLA ->porcentaje = $request ->porcentaje;
                $SLA ->hora_atraso = $request ->hora_atraso;
                $SLA ->estado = "Activo";
                $SLA -> save();
            }

        }
        return redirect()->back();
    }

    public function actualizarSLA(Request $request)
    {
        $user = \Auth::user()->user_red;
        if($request->ajax()){

            $sla=SLA::orderBy('created_at','DESC')
                ->select('sla.*')
                ->where('sla.porcentaje', '=', $request ->porcentaje)
                ->get();

            $SLA = SLA::find($request->id);
            if($sla=="[]"){
            $SLA ->porcentaje = $request ->porcentaje;
            }
            $SLA ->hora_atraso = $request ->hora_atraso;
            $SLA ->estado = $request ->estado;
            $SLA ->justificacion = $request ->justificacion;
            $SLA ->registro = $user;
            $SLA -> save();
        }

        return redirect()->back();
    }

    public static function buscarSLA($id){
        $pSLA = PSLA::orderBy('created_at', 'DESC')
            ->select('proceso_sla.*','proceso_sla.id as idPS', 'procesos.id','sla.porcentaje','turnos.nombre')
            ->join('procesos','proceso_sla.FK_Proceso', '=', 'procesos.id')
            ->join('turnos','procesos.FK_Turno', '=', 'turnos.id')
            ->join('sla','proceso_sla.FK_SLA','=','sla.id')
            ->where('proceso_sla.FK_Proceso', '=', $id)
            ->where('turnos.nombre','!=', "Noche")
            ->where('proceso_sla.fecha', '=', Carbon::now()->toDateString());

        $pSLANoche = PSLA::orderBy('created_at', 'DESC')
            ->select('proceso_sla.*','proceso_sla.id as idPS', 'procesos.id','sla.porcentaje','turnos.nombre')
            ->join('procesos','proceso_sla.FK_Proceso', '=', 'procesos.id')
            ->join('turnos','procesos.FK_Turno', '=', 'turnos.id')
            ->join('sla','proceso_sla.FK_SLA','=','sla.id')
            ->where('proceso_sla.FK_Proceso', '=', $id)
            ->where('turnos.nombre','=', "Noche")
            ->where('proceso_sla.fecha', '=', Carbon::yesterday()->toDateString())
            ->union($pSLA)
            ->get();


        return $pSLANoche;
    }


    public static function buscarSLAFiltro($id,$fecha){
        $pSLA = PSLA::orderBy('created_at', 'DESC')
            ->select('proceso_sla.*','proceso_sla.id as idPS', 'procesos.id','sla.porcentaje','turnos.nombre')
            ->join('procesos','proceso_sla.FK_Proceso', '=', 'procesos.id')
            ->join('turnos','procesos.FK_Turno', '=', 'turnos.id')
            ->join('sla','proceso_sla.FK_SLA','=','sla.id')
            ->where('proceso_sla.FK_Proceso', '=', $id)
            ->where('turnos.nombre','!=', "Noche")
            ->where('proceso_sla.fecha', '=', Carbon::now()->toDateString());

        $pSLANoche = PSLA::orderBy('created_at', 'DESC')
            ->select('proceso_sla.*','proceso_sla.id as idPS', 'procesos.id','sla.porcentaje','turnos.nombre')
            ->join('procesos','proceso_sla.FK_Proceso', '=', 'procesos.id')
            ->join('turnos','procesos.FK_Turno', '=', 'turnos.id')
            ->join('sla','proceso_sla.FK_SLA','=','sla.id')
            ->where('proceso_sla.FK_Proceso', '=', $id)
            ->where('turnos.nombre','=', "Noche")
            ->where('proceso_sla.fecha', '=', Carbon::yesterday()->toDateString())
            ->union($pSLA)
            ->get();


        return $pSLANoche;
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $SLA=SLA::find($id);
        $SLA->delete();
        return redirect()->back();
    }
}
