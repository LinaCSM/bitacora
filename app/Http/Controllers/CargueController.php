<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Cargue;
use App\Models\Tipo as TipoR;
use App\Models\Pais as Pais;
use App\Models\Cargue_Grupo as CargueGrupo;
use Illuminate\Support\Facades\Session;
class CargueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $cargues=Cargue::orderBy('created_at','DESC')
            ->select('cargues.*', 'grupos.nombre as Grupo','paises.nombre as Pais','tipos.nombre as Responsable')
            ->join('cargue_grupo','cargue_grupo.FK_Cargue','=','cargues.id')
            ->join('grupos','cargue_grupo.FK_Grupo','=','grupos.id')
            ->join('paises','grupos.FK_Pais','=','paises.id')
            ->join('tipos','cargues.FK_Tipo','=','tipos.id')
            ->get();

        return view('Cargues/listCargue', compact('cargues'));
    }

    public function indexA1()
    {
        $tipoUsuario = \Auth::user()->FK_Tipo;
        if($tipoUsuario=="1" || $tipoUsuario=="2"){
            $cargues=Cargue::orderBy('created_at','DESC')
                ->select('cargues.*', 'grupos.nombre as Grupo','paises.nombre as Pais','tipos.nombre as Responsable',
                    'grupos.FK_Pais','cargue_grupo.FK_Grupo','cargue_grupo.id as idCG')
                ->join('cargue_grupo','cargue_grupo.FK_Cargue','=','cargues.id')
                ->join('grupos','cargue_grupo.FK_Grupo','=','grupos.id')
                ->join('paises','grupos.FK_Pais','=','paises.id')
                ->join('tipos','cargues.FK_Tipo','=','tipos.id')
                ->get();

            $carguesColombia=Cargue::orderBy('created_at','DESC')
                ->select('cargues.*', 'grupos.nombre as Grupo','paises.nombre as Pais','tipos.nombre as Responsable')
                ->join('cargue_grupo','cargue_grupo.FK_Cargue','=','cargues.id')
                ->join('grupos','cargue_grupo.FK_Grupo','=','grupos.id')
                ->join('paises','grupos.FK_Pais','=','paises.id')
                ->join('tipos','cargues.FK_Tipo','=','tipos.id')
                ->where('paises.nombre','=','Colombia')
                ->get();

            $carguesPanama=Cargue::orderBy('created_at','DESC')
                ->select('cargues.*', 'grupos.nombre as Grupo','paises.nombre as Pais','tipos.nombre as Responsable')
                ->join('cargue_grupo','cargue_grupo.FK_Cargue','=','cargues.id')
                ->join('grupos','cargue_grupo.FK_Grupo','=','grupos.id')
                ->join('paises','grupos.FK_Pais','=','paises.id')
                ->join('tipos','cargues.FK_Tipo','=','tipos.id')
                ->where('paises.nombre','=','Panama')
                ->get();
        }else{
            $cargues=Cargue::orderBy('created_at','DESC')
                ->select('cargues.*', 'grupos.nombre as Grupo','paises.nombre as Pais','tipos.nombre as Responsable',
                    'grupos.FK_Pais','cargue_grupo.FK_Grupo','cargue_grupo.id as idCG')
                ->join('cargue_grupo','cargue_grupo.FK_Cargue','=','cargues.id')
                ->join('grupos','cargue_grupo.FK_Grupo','=','grupos.id')
                ->join('paises','grupos.FK_Pais','=','paises.id')
                ->join('tipos','cargues.FK_Tipo','=','tipos.id')
                ->where('tipos.id','=',$tipoUsuario)
                ->get();

            $carguesColombia=Cargue::orderBy('created_at','DESC')
                ->select('cargues.*', 'grupos.nombre as Grupo','paises.nombre as Pais','tipos.nombre as Responsable')
                ->join('cargue_grupo','cargue_grupo.FK_Cargue','=','cargues.id')
                ->join('grupos','cargue_grupo.FK_Grupo','=','grupos.id')
                ->join('paises','grupos.FK_Pais','=','paises.id')
                ->join('tipos','cargues.FK_Tipo','=','tipos.id')
                ->where('tipos.id','=',$tipoUsuario)
                ->where('paises.nombre','=','Colombia')
                ->get();

            $carguesPanama=Cargue::orderBy('created_at','DESC')
                ->select('cargues.*', 'grupos.nombre as Grupo','paises.nombre as Pais','tipos.nombre as Responsable')
                ->join('cargue_grupo','cargue_grupo.FK_Cargue','=','cargues.id')
                ->join('grupos','cargue_grupo.FK_Grupo','=','grupos.id')
                ->join('paises','grupos.FK_Pais','=','paises.id')
                ->join('tipos','cargues.FK_Tipo','=','tipos.id')
                ->where('tipos.id','=',$tipoUsuario)
                ->where('paises.nombre','=','Panama')
                ->get();
        }

        $tipos= TipoR::orderBy('id','ASC')
            ->select('tipos.*')
            ->where('nombre','LIKE','%A1%')
            ->pluck('nombre','id');

        $paises = Pais::pluck('nombre','id');


        return view('Cargues/listCargueA1', compact('carguesColombia','carguesPanama','cargues','tipos','paises'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipos= TipoR::orderBy('id','ASC')
            ->select('nombre','id')
            ->where('nombre','LIKE','%A1%')
            ->get();

        $paises = Pais::orderBy('id','ASC')->select('id','nombre')->get();

        return view('Cargues/NewCargue',compact('tipos','paises'));
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

            $buscarCargue = Cargue::orderBy('id','ASC')
                ->select('cargues.*')
                ->where('cargues.nombre', '=', $request->nombre)
                ->where('cargues.plataforma','=',$request->plataforma)
                ->get();

            if($buscarCargue=="[]"){

                $Cargue = new Cargue();
                $Cargue ->nombre = $request ->nombre;
                $Cargue ->tipo_archivo = $request ->t_archivo;
                $Cargue ->plataforma = $request ->plataforma;
                $Cargue ->servidor = $request ->servidor;
                $Cargue ->catalogo = $request ->catalogo;
                $Cargue ->bd = $request ->bd;
                $Cargue ->job = $request ->job;
                $Cargue ->tarea = $request ->tarea;
                $Cargue ->ruta = $request ->ruta;
                $Cargue ->periodicidad = $request ->periodicidad;
                $Cargue ->hora_ejecucion = $request ->horario;
                $Cargue ->estado = "Correcto";
                $Cargue ->FK_Tipo = $request ->tipo;
                $Cargue -> save();

                $CargueG = Cargue::orderBy('id','ASC')
                    ->select('cargues.*')
                    ->where('cargues.nombre', '=', $request ->nombre)
                    ->where('cargues.plataforma','=',$request ->plataforma)
                    ->get();

                foreach ($CargueG as $cargue){
                    $CargueG = new CargueGrupo();
                    $CargueG ->FK_Grupo = $request ->FK_Grupo;
                    $CargueG ->FK_Cargue = $cargue ->id;
                    $CargueG -> save();
                }


                Session::flash('flash_message', 'Proceso registrado exitosamente.');
            }else if($buscarCargue!="[]"){

                Session::flash('error_message', 'El proceso ya se encuentra registrado');
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
        $Cargue = Cargue::find($id);
        return\View::make('Cargues/UpdateCargue', compact('$Cargue'));
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
        $usuario = \Auth::user()->user_red;
        $Cargue = Cargue::find($request->id);
        $Cargue ->estado = $request ->estado;
        $Cargue ->justificacion = $request ->justificacion;
        $Cargue ->registro = $usuario;
        $Cargue -> save();

        return redirect()->back();
    }

    public function actualizarCargue(Request $request){
        $usuario = \Auth::user()->user_red;
        if($request->ajax()){

            $Cargue = Cargue::find($request->id);
            $Cargue ->nombre = $request ->nombre;
            $Cargue ->tipo_archivo = $request ->t_archivo;
            $Cargue ->plataforma = $request ->plataforma;
            $Cargue ->servidor = $request ->servidor;
            $Cargue ->catalogo = $request ->catalogo;
            $Cargue ->bd = $request ->bd;
            $Cargue ->job = $request ->job;
            $Cargue ->tarea = $request ->tarea;
            $Cargue ->ruta = $request ->ruta;
            $Cargue ->periodicidad = $request ->periodicidad;
            $Cargue ->hora_ejecucion = $request ->horario;
            $Cargue ->registro = $usuario;
            $Cargue ->FK_Tipo = $request ->tipo;
            $Cargue -> save();

            $CargueG = CargueGrupo::find($request->idCG);
            $CargueG ->FK_Grupo = $request ->FK_Grupo;
            $CargueG ->FK_Cargue = $request ->id;
            $CargueG -> save();
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
        $Cargue=Cargue::find($id);
        $Cargue->delete();
        return redirect()->back();
    }
}
