<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo as Grupo;
use App\Models\Pais as Pais;
use App\Models\Proceso as Proceso;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Grupo=Grupo::orderBy('id','DESC')
            ->select('grupos.*','paises.nombre as pais')
            ->join('paises','grupos.FK_Pais','=','paises.id')
            ->get();

        $paises = Pais::pluck('nombre','id');
        $pais = Pais::orderBy('id','ASC')->select('id','nombre')->get();

        return view('Grupos/listGrupo', compact('Grupo','paises','pais'));
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
        $grupos=Grupo::orderBy('created_at','DESC')
            ->select('grupos.*')
            ->join('paises','grupos.FK_Pais','=','paises.id')
            ->where('grupos.nombre', '=', $request ->nombre)
            ->where('grupos.FK_Pais', '=', $request ->pais)
            ->get();

        if($grupos=="[]"){
            $Grupo = new Grupo();
            $Grupo ->nombre = $request ->nombre;
            $Grupo ->descripcion = $request ->descripcion;
            $Grupo ->FK_Pais = $request ->pais;
            $Grupo ->estado = "Activo";
            $Grupo -> save();
        }else{
        /*Mensaje indicando que el grupo ya se encuentra registrado*/
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
        $Grupo = Grupo::find($id);
        return view('Grupos/UpdateGrupo', compact('Grupo'));
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

        $grupos=Grupo::orderBy('created_at','DESC')
            ->select('grupos.*')
            ->join('paises','grupos.FK_Pais','=','paises.id')
            ->where('grupos.nombre', '=', $request ->nombre)
            ->where('grupos.FK_Pais', '=', $request ->FK_Pais)
            ->get();

        $Grupo = Grupo::find($request->id);
        if($grupos=="[]"){
            $Grupo ->nombre = $request ->nombre;
        }
        $Grupo ->descripcion = $request ->descripcion;
        $Grupo ->estado = $request ->estado;
        if($grupos=="[]"){
         $Grupo ->FK_Pais = $request ->FK_Pais;
        }
        $Grupo ->justificacion = $request ->justificacion;
        $Grupo ->registro = $user;
        $Grupo -> save();

        if($request ->estado=="Inactivo"){
            $procesos=Proceso::orderBy('id','ASC')
                ->select('procesos.*')
                ->where('procesos.FK_Grupo', '=', $request->id)
                ->get();

            foreach ($procesos as $Proceso){
                $procesoT = Proceso::find($Proceso->id);
                $procesoT ->estado = $request ->estado;
                $procesoT ->justificacion = "El grupo asociado ha sido inactivado por ".$request ->justificacion;
                $procesoT->save();
            }
        }else{
            $procesos=Proceso::orderBy('id','ASC')
                ->select('procesos.*')
                ->where('procesos.FK_Grupo', '=', $request->id)
                ->get();

            foreach ($procesos as $Proceso){
                $procesoT = Proceso::find($Proceso->id);
                $procesoT ->estado = $request ->estado;
                $procesoT ->justificacion = "";
                $procesoT->save();
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
        $Grupo=Grupo::find($id);
        $Grupo->delete();
        return redirect()->back();
    }
}
