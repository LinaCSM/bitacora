<?php

namespace App\Http\Controllers;

use App\Models\Usuario as Responsable;
use App\Models\Tipo as Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoUsuario = \Auth::user()->FK_Tipo;

        if($tipoUsuario=="3" || $tipoUsuario=="4" || $tipoUsuario=="5" || $tipoUsuario=="6"){
            $responsables=Responsable::orderBy('name','ASC')
                ->select('users.*','tipos.nombre as FK_Tipo','tipos.id as Tipo')
                ->join('tipos','users.FK_Tipo','=','tipos.id')
                ->where(function ($query){
                    $tipoUsuario = \Auth::user()->FK_Tipo;
                    $query->where('tipos.nombre', 'LIKE', '%A1%')
                        ->orWhere('tipos.nombre', '=', 'Analista2');
                })
                ->get();
        }else{
            $responsables=Responsable::orderBy('name','ASC')
                ->select('users.*','tipos.nombre as FK_Tipo','tipos.id as Tipo')
                ->join('tipos','users.FK_Tipo','=','tipos.id')
                ->get();
        }

        $tipos = Tipo::pluck('nombre','id');

        $tipo= Tipo::orderBy('id','ASC')
            ->select('nombre','id')
            ->get();


        return view('Usuarios/listUsuarios', compact('responsables','tipos','tipo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipos= Tipo::orderBy('id','ASC')
            ->select('nombre','id')
            ->get();

        return view('Usuarios/NewUsuario', compact('tipos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $responsables=Responsable::orderBy('name','ASC')
                ->select('users.*')
                ->where('users.identificacion','=',$request->identificacion)
                ->where('users.user_red','=',$request->usuarioRed)
                ->get();

            if($responsables=="[]"){
                $Usuario = new Responsable();
                $Usuario->identificacion = $request->identificacion;
                $Usuario->name = $request->nombre;
                $Usuario->lastname = $request->apellido;
                $Usuario->user_red = $request->usuarioRed;
                $Usuario->password = \Hash::make($request->contrasena);
                $Usuario->FK_Tipo = $request->tipo;
                $Usuario->state = "Activo";
                $Usuario->attempts = "0";
                $Usuario->save();
            }

        return redirect()->back();
    }

    public function actualizarUsuario(Request $request){

        if($request->ajax()){

            if($request->cambioContra=="Si"){

                $responsables=Responsable::orderBy('name','ASC')
                    ->select('users.*')
                    ->where('users.identificacion','=',$request->identificacion)
                    ->where('users.user_red','=',$request->usuarioRed)
                    ->get();

                $usuario = Responsable::find($request->id);
                if($responsables=="[]"){
                    $usuario->identificacion = $request->identificacion;
                }
                $usuario->name = $request->nombre;
                $usuario->lastname = $request->apellido;
                if($responsables=="[]"){
                    $usuario->user_red = $request->user_red;
                }
                $usuario->password = \Hash::make($request->contrasena);
                $usuario->FK_Tipo = $request->tipo;
                $usuario->save();
                return redirect()->back();
            }else{
                $responsables=Responsable::orderBy('name','ASC')
                    ->select('users.*')
                    ->where('users.identificacion','=',$request->identificacion)
                    ->where('users.user_red','=',$request->usuarioRed)
                    ->get();

                $usuario = Responsable::find($request->id);
                if($responsables=="[]") {
                    $usuario->identificacion = $request->identificacion;
                }
                $usuario->name = $request->nombre;
                $usuario->lastname = $request->apellido;
                if($responsables=="[]"){
                    $usuario->user_red = $request->user_red;
                }
                $usuario->FK_Tipo = $request->tipo;
                $usuario->save();
                return redirect()->back();
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
        $responsables = Responsable::find($id);
        return\View::make('Usuarios/ModalCambioEstado', compact('responsables'));
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
        $Usuario = Responsable::find($request->id);
        $Usuario ->state = $request ->state;
        $Usuario ->justificacion = $request ->justificacion;
        $Usuario ->registro = $user;
        $Usuario -> save();

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
        $Usuario = Responsable::find($id);
        $Usuario -> delete();

        return redirect()->back();
    }
}
