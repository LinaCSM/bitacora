<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turno as Turno;
use App\Models\Proceso as Proceso;

class TurnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $turnos=Turno::orderBy('created_at','DESC')
            ->select('turnos.*')
            ->get();


        return view('Turnos/listTurno', compact('turnos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('Turno/NewTurno');
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

            $turno=Turno::orderBy('created_at','DESC')
                ->select('turnos.*')
                ->where('turnos.nombre', '=', $request ->nombre)
                ->get();

            if($turno=="[]"){
                $Turno = new Turno();
                $Turno ->nombre = $request ->nombre;
                $Turno ->hora_inicio = $request ->hora_inicio;
                $Turno ->hora_final = $request ->hora_final;
                $Turno ->estado = "Activo";
                $Turno -> save();
            }

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
        $turnos = Turno::find($id);
        return view('Turno/UpdateTurno', compact('turnos'));
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


        return redirect()->back();
    }

    public function actualizarTurno(Request $request)
    {
        $user = \Auth::user()->user_red;

        if($request->ajax()){

            $turno=Turno::orderBy('created_at','DESC')
                ->select('turnos.*')
                ->where('turnos.nombre', '=', $request ->nombre)
                ->get();


                $Turno = Turno::find($request->id);
                if($turno=="[]") {
                    $Turno->nombre = $request->nombre;
                }
                $Turno ->hora_inicio = $request ->hora_inicio;
                $Turno ->hora_final = $request ->hora_final;
                $Turno ->estado = $request ->estado;
                $Turno ->justificacion = $request ->justificacion;
                $Turno ->registro = $user;
                $Turno -> save();

                if($request ->estado=="Inactivo"){
                    $procesos=Proceso::orderBy('id','ASC')
                        ->select('procesos.*')
                        ->where('procesos.FK_Turno', '=', $request->id)
                        ->get();

                    foreach ($procesos as $Proceso){
                        $procesoT = Proceso::find($Proceso->id);
                        $procesoT ->estado = $request ->estado;
                        $procesoT ->justificacion = "El turno asociado ha sido inactivado por ".$request->justificacion;
                        $procesoT->save();
                    }
                }else{
                    $procesos=Proceso::orderBy('id','ASC')
                        ->select('procesos.*')
                        ->where('procesos.FK_Turno', '=', $request->id)
                        ->get();

                    foreach ($procesos as $Proceso){
                        $procesoT = Proceso::find($Proceso->id);
                        $procesoT ->estado = $request ->estado;
                        $procesoT ->justificacion = "";
                        $procesoT->save();
                    }
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
        $Turno=Turno::find($id);
        $Turno->delete();
        return redirect()->back();
    }
}
