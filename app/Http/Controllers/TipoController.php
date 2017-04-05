<?php

namespace App\Http\Controllers;

use App\Models\Tipo as Tipo;
use App\Models\Usuario as Usuario;
use App\Models\Proceso as Proceso;

use Illuminate\Http\Request;

class TipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos=Tipo::orderBy('id','ASC')->select('tipos.*')->get();
        return view('Tipos/listTipo',compact('tipos'));
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
        $tipos=Tipo::orderBy('created_at','DESC')
            ->select('tipos.*')
            ->where('tipos.nombre', '=', $request ->nombre)
            ->get();

        if($tipos=="[]"){
            $Tipo = new Tipo();
            $Tipo ->nombre = $request ->nombre;
            $Tipo ->estado = "Activo";
            $Tipo -> save();
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
        $tipos = Tipo::find($id);
        return view('Tipos/UpdateTipo', compact('tipos'));
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

        $Tipo = Tipo::find($request->id);
        $Tipo ->nombre = $request ->nombre;
        $Tipo ->estado = $request ->estado;
        $Tipo ->justificacion = $request ->justificacion;
        $Tipo ->registro = $user;
        $Tipo -> save();

        if($request ->estado=="Inactivo"){
            $Proceso=Proceso::orderBy('id','ASC')
                ->select('procesos.*')
                ->where('procesos.FK_Tipo', '=', $request->id)
                ->get();

            $Usuario=Usuario::orderBy('id','ASC')
                ->select('users.*')
                ->where('users.FK_Tipo', '=', $request->id)
                ->get();

            foreach ($Proceso as $proceso){
                $Proceso = Proceso::find($proceso->id);
                $Proceso ->estado = $request ->estado;
                $Proceso ->justificacion = "El tipo asociado ha sido inactivado por ".$request ->justificacion;
                $Proceso->save();
            }

            foreach ($Usuario as $usuario){

                $Responsable = Usuario::find($usuario->id);
                $Responsable ->state = $request ->estado;
                $Responsable ->justificacion = "El tipo asociado ha sido inactivado por ".$request ->justificacion;
                $Responsable ->registro = $user;
                $Responsable->save();
            }

        }else {

            $Proceso = Proceso::orderBy('id', 'ASC')
                ->select('procesos.*')
                ->where('procesos.FK_Tipo', '=', $request->id)
                ->get();

            $Usuario = Usuario::orderBy('id', 'ASC')
                ->select('users.*')
                ->where('users.FK_Tipo', '=', $request->id)
                ->get();

            foreach ($Proceso as $proceso) {
                $Proceso = Proceso::find($proceso->id);
                $Proceso->estado = $request->estado;
                $Proceso->justificacion = "";
                $Proceso->save();
            }

            foreach ($Usuario as $usuario) {

                $Responsable = Usuario::find($usuario->id);
                $Responsable->state = $request->estado;
                $Responsable->justificacion = "";
                $Responsable ->registro = $user;
                $Responsable->save();
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
        $Tipo=Tipo::find($id);
        $Tipo->delete();
        return redirect()->back();
    }
}
