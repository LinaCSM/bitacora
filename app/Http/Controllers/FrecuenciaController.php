<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Frecuencia as Frecuencia;
use App\Models\Proceso as Proceso;
use App\Models\Frecuencia_Proceso as FProceso;

class FrecuenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Frecuencia=Frecuencia::orderBy('id','DESC')
            ->select('frecuencias.*')
            ->get();
        return view('Frecuencias/listFrecuencia', compact('Frecuencia'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
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
        $frecuencia=Frecuencia::orderBy('created_at','DESC')
            ->select('frecuencias.*')
            ->where('frecuencias.nombre', '=', $request ->nombre)
            ->get();

        if($frecuencia=="[]"){
            $Frecuencia = new Frecuencia();
            $Frecuencia ->nombre = $request ->nombre;
            $Frecuencia ->estado = "Activo";
            $Frecuencia -> save();
        }
        return redirect()->back();
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
        $Frecuencia = Frecuencia::find($id);
        return view('Frecuencias/UpdateFrecuencia', compact('Frecuencia'));
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
        $user = \Auth::user()->user_red;

        $frecuencia = Frecuencia::orderBy('created_at', 'DESC')
            ->select('frecuencias.*')
            ->where('frecuencias.nombre', '=', $request->nombre)
            ->get();


        $Frecuencia = Frecuencia::find($request->id);
        if ($frecuencia == "[]") {
            $Frecuencia->nombre = $request->nombre;
        }
        $Frecuencia ->estado = $request ->estado;
        $Frecuencia ->justificacion = $request ->justificacion;
        $Frecuencia ->registro = $user;
        $Frecuencia -> save();

        if($request ->estado=="Inactivo"){
            $fProceso=FProceso::orderBy('FK_Proceso','ASC')
                ->select('frecuencia_proceso.FK_Proceso')
                ->where('frecuencia_proceso.FK_Frecuencia', '=', $request->id)
                ->get();

            foreach ($fProceso as $frecuenciaP){
                $Proceso = Proceso::find($frecuenciaP->FK_Proceso);
                $Proceso ->estado = $request ->estado;
                $Proceso ->justificacion = "La frecuencia asociada ha sido inactivada por ".$request ->justificacion;
                $Proceso->save();
            }
        }else{
            $fProceso=FProceso::orderBy('id','ASC')
                ->select('frecuencia_proceso.*')
                ->where('frecuencia_proceso.FK_Frecuencia', '=', $request->id)
                ->get();

            foreach ($fProceso as $frecuenciaP){
                $Proceso = Proceso::find($frecuenciaP->FK_Proceso);
                $Proceso ->estado = $request ->estado;
                $Proceso ->justificacion = "";
                $Proceso->save();
            }
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
        $Frecuencia=Frecuencia::find($id);
        $Frecuencia->delete();
        return redirect()->back();
    }
}
