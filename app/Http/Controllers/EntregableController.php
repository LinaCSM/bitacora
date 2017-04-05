<?php

namespace App\Http\Controllers;

use App\Models\Asignacion as Asignacion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Entregable as Entregable;
use App\Models\Proceso as Proceso;
use Illuminate\Support\Facades\DB;

class EntregableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function entregable(){
        $entregables= Entregable::select('entregables.id as idEntregable','procesos.id as idP','procesos.nombre as Proceso', 'entregables.tipo',
            'entregables.ruta','procesos.sysdate','procesos.plataforma','frecuencias.nombre as frecuencia',
            'procesos.servidor','procesos.catalogo','paises.nombre as Pais','grupos.nombre as Grupo',
            'tipos.nombre as Responsable','entregables.estado','entregables.justificacion','procesos.justificacion',
            DB::raw('addtime(procesos.Horario,procesos.t_ejecucion) as hora_aproximada'))
            ->join('asignacion','asignacion.FK_Entregable','=','entregables.id')
            ->join('procesos','asignacion.FK_Proceso','=','procesos.id')
            ->join('frecuencia_proceso','frecuencia_proceso.FK_Proceso','=','procesos.id')
            ->join('frecuencias','frecuencia_proceso.FK_Frecuencia','=','frecuencias.id')
            ->join('tipos','procesos.FK_Tipo','=','tipos.id')
            ->join('grupos','procesos.FK_Grupo','=','grupos.id')
            ->join('paises','grupos.FK_Pais','=','paises.id')
            ->get();
        return $entregables;
    }

    public function index()
    {

        $tipoUsuario = \Auth::user()->FK_Tipo;

        if($tipoUsuario=="1" || $tipoUsuario=="2" || $tipoUsuario=="7"){
            $entregables= Entregable::select( DB::raw('DISTINCT(asignacion.id)'),'entregables.id',
                'procesos.id as idP','procesos.nombre as Proceso', 'entregables.tipo','entregables.ruta',
                'procesos.sysdate','procesos.plataforma','frecuencias.nombre as frecuencia','procesos.servidor',
                'procesos.catalogo','paises.nombre as Pais','grupos.nombre as Grupo','tipos.nombre as Responsable',
                'entregables.estado','procesos.justificacion','asignacion.id as Asignacion','entregables.justificacion',
                DB::raw('addtime(procesos.Horario,procesos.t_ejecucion) as hora_aproximada'))
                ->join('asignacion','asignacion.FK_Entregable','=','entregables.id')
                ->join('procesos','asignacion.FK_Proceso','=','procesos.id')
                ->join('frecuencia_proceso','frecuencia_proceso.FK_Proceso','=','procesos.id')
                ->join('frecuencias','frecuencia_proceso.FK_Frecuencia','=','frecuencias.id')
                ->join('tipos','procesos.FK_Tipo','=','tipos.id')
                ->join('grupos','procesos.FK_Grupo','=','grupos.id')
                ->join('paises','grupos.FK_Pais','=','paises.id')
                ->get();
        }else{
            $entregables= Entregable::select(DB::raw('DISTINCT(asignacion.id)'),'entregables.id','procesos.id as idP','procesos.nombre as Proceso', 'entregables.tipo',
                'entregables.ruta','procesos.sysdate',DB::raw('addtime(procesos.Horario,procesos.t_ejecucion) as hora_aproximada'),
                'procesos.plataforma','frecuencias.nombre as FK_Frecuencia','procesos.servidor','procesos.catalogo',
                'paises.nombre as Pais','grupos.nombre as Grupo','tipos.nombre as Responsable','entregables.estado',
                'procesos.justificacion','asignacion.id as Asignacion')
                ->join('asignacion','asignacion.FK_Entregable','=','entregables.id')
                ->join('procesos','asignacion.FK_Proceso','=','procesos.id')
                ->join('frecuencia_proceso','frecuencia_proceso.FK_Proceso','=','procesos.id')
                ->join('frecuencias','frecuencia_proceso.FK_Frecuencia','=','frecuencias.id')
                ->join('tipos','procesos.FK_Tipo','=','tipos.id')
                ->join('grupos','procesos.FK_Grupo','=','grupos.id')
                ->join('paises','grupos.FK_Pais','=','paises.id')
                ->where('tipos.id','=',$tipoUsuario)
                ->get();
        }

        $procesos=Proceso::pluck('nombre','id');

        return view('Entregables/listEntregable',  compact('entregables','procesos'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entregables=Entregable::orderBy('id','DESC');
        $procesos=Proceso::orderBy('id','ASC')->select('id','nombre')->get();
        return view('Entregables/NewEntregable', compact('entregables','procesos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $buscarEntregable = Entregable::orderBy('id','ASC')
            ->select('entregables.*')
            ->where('entregables.tipo', '=', $request->tipo)
            ->where('entregables.ruta','=',$request->ruta)
            ->get();

        if($buscarEntregable=="[]"){
            $Entregable = new Entregable();
            $Entregable->tipo = $request->tipo;
            $Entregable->ruta = $request->ruta;
            $Entregable->estado = "Activo";
            $Entregable->save();

            $entregable=Entregable::orderBy('id','ASC')
                ->select('entregables.id')
                ->where('entregables.tipo', '=', $request->tipo)
                ->where('entregables.ruta','=',$request->ruta)
                ->get();

            if($entregable!="[]"){
                foreach ($entregable as $Entregable){
                    $idEntregable=$Entregable->id;

                    $buscarAsignacion = Asignacion::orderBy('id','ASC')
                        ->select('asignacion.*')
                        ->where('asignacion.FK_Entregable', '=', $idEntregable)
                        ->where('asignacion.FK_Proceso','=',$request->proceso)
                        ->get();
                    if($buscarAsignacion=="[]"){
                        $Asignacion = new Asignacion();
                        $Asignacion->FK_Proceso = $request->proceso;
                        $Asignacion->FK_Entregable = $idEntregable;
                        $Asignacion->save();
                    }
                }
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
        $entregables = Entregable::find($id);
        return\View::make('Entregables/listEntregable', compact('entregables'));
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

        $buscarEntregable = Entregable::orderBy('id','ASC')
            ->select('entregables.*')
            ->where('entregables.tipo', '=', $request->tipo)
            ->where('entregables.ruta','=',$request->ruta)
            ->get();

        if($buscarEntregable=="[]"){
            $Entregable = Entregable::find($request->entregable);
            $Entregable ->ruta = $request ->ruta;
            $Entregable ->tipo = $request ->tipo;
            $Entregable -> save();

            $Asignacion= Asignacion::find($request->asignacion);
            $Asignacion ->FK_Proceso = $request ->idP;
            $Asignacion ->FK_Entregable = $request ->entregable;
            $Asignacion -> save();
        }


        return redirect()->back();
    }


    public function actualizarEstado(Request $request){

        $Entregable = Entregable::find($request->id);
        $Entregable ->estado = $request ->estado;
        $Entregable ->justificacion = $request ->justificacion;
        $Entregable -> save();

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
        $entregables=Entregable::find($id);
        $entregables->delete();

        return redirect()->back();
    }
}
