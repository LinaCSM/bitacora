<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Proceso as Proceso;
use App\Models\Frecuencia as Frecuencia;
use App\Models\Frecuencia_Proceso as FrecuenciaP;
use App\Models\Grupo as Grupo;
use App\Models\Pais as Pais;
use App\Models\Tipo as TipoR;
use App\Models\Turno as Turno;
use App\Models\Asignacion as Asignacion;
use App\Models\Entregable as Entregable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class ProcesoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoUsuario = \Auth::user()->FK_Tipo;

        if($tipoUsuario=="1" || $tipoUsuario=="2" || $tipoUsuario=="7"){
            $procesosDiarios=Proceso::orderBy('created_at','DESC')
                ->select('procesos.*', 'grupos.nombre as Grupo','grupos.FK_Pais','turnos.nombre as Turno',
                    'procesos.FK_Tipo','tipos.nombre as Tipo','frecuencia_proceso.FK_Frecuencia','frecuencias.id as Frecuencia',
                    'frecuencia_proceso.dia as dias_frecuencia','paises.nombre as Pais')
                ->join('turnos','procesos.FK_Turno','=','turnos.id')
                ->join('tipos','procesos.FK_Tipo','=','tipos.id')
                ->join('frecuencia_proceso','frecuencia_proceso.FK_Proceso','=','procesos.id')
                ->join('frecuencias','frecuencia_proceso.FK_Frecuencia','=','frecuencias.id')
                ->join('grupos','procesos.FK_Grupo','=','grupos.id')
                ->join('paises','grupos.FK_Pais','=','paises.id')
                ->where('frecuencias.nombre', '=', 'diaria')
                ->get();

        }else{
            $procesosDiarios=Proceso::orderBy('created_at','DESC')
                ->select('procesos.*', 'grupos.nombre as Grupo','grupos.FK_Pais','turnos.nombre as Turno',
                    'procesos.FK_Tipo','tipos.nombre as Tipo','frecuencia_proceso.FK_Frecuencia','frecuencias.id as Frecuencia',
                    'frecuencia_proceso.dia as dias_frecuencia','paises.nombre as Pais')
                ->join('turnos','procesos.FK_Turno','=','turnos.id')
                ->join('tipos','procesos.FK_Tipo','=','tipos.id')
                ->join('frecuencia_proceso','frecuencia_proceso.FK_Proceso','=','procesos.id')
                ->join('frecuencias','frecuencia_proceso.FK_Frecuencia','=','frecuencias.id')
                ->join('grupos','procesos.FK_Grupo','=','grupos.id')
                ->join('paises','grupos.FK_Pais','=','paises.id')
                ->where('frecuencias.nombre', '=', 'diaria')
                ->where('tipos.id','=',$tipoUsuario)
                ->get();
        }

        $tipos= TipoR::orderBy('id','ASC')
            ->select('tipos.*')
            ->where('nombre','LIKE','%A1%')
            ->pluck('nombre','id');

        $responsable= TipoR::orderBy('id','ASC')
            ->select('tipos.*')
            ->where('nombre','LIKE','%A1%')
            ->where('id','!=',$tipoUsuario)
            ->pluck('nombre','id');

        $frecuencias = Frecuencia::pluck('nombre','id');

        $diaFrecuencia = FrecuenciaP::pluck('dia','id');

        $grupos = Grupo::pluck('nombre','id');

        $paises = Pais::pluck('nombre','id');

        $turnos = Turno::pluck('nombre','id');

        return \View::make('Procesos/listProceso', compact('procesosDiarios','tipos','responsable','frecuencias','diaFrecuencia','grupos','paises','turnos'));
    }

    public function indexMensual()
    {
        $tipoUsuario = \Auth::user()->FK_Tipo;

        if($tipoUsuario=="1" || $tipoUsuario=="2" || $tipoUsuario=="7") {
            $procesosMensuales = Proceso::orderBy('created_at', 'DESC')
                ->select('procesos.*', 'grupos.nombre as Grupo', 'grupos.FK_Pais', 'turnos.nombre as Turno',
                    'procesos.FK_Tipo', 'tipos.nombre as Tipo', 'frecuencia_proceso.FK_Frecuencia',
                    'frecuencias.id as Frecuencia', 'frecuencia_proceso.dia as dias_frecuencia', 'paises.nombre as Pais')
                ->join('turnos', 'procesos.FK_Turno', '=', 'turnos.id')
                ->join('tipos', 'procesos.FK_Tipo', '=', 'tipos.id')
                ->join('frecuencia_proceso', 'frecuencia_proceso.FK_Proceso', '=', 'procesos.id')
                ->join('frecuencias', 'frecuencia_proceso.FK_Frecuencia', '=', 'frecuencias.id')
                ->join('grupos', 'procesos.FK_Grupo', '=', 'grupos.id')
                ->join('paises', 'grupos.FK_Pais', '=', 'paises.id')
                ->where('frecuencias.nombre', '=', 'Mensual')
                ->get();
        }else{
            $procesosMensuales = Proceso::orderBy('created_at', 'DESC')
                ->select('procesos.*', 'grupos.nombre as Grupo', 'grupos.FK_Pais', 'turnos.nombre as Turno',
                    'procesos.FK_Tipo', 'tipos.nombre as Tipo', 'frecuencia_proceso.FK_Frecuencia',
                    'frecuencias.id as Frecuencia', 'frecuencia_proceso.dia as dias_frecuencia', 'paises.nombre as Pais')
                ->join('turnos', 'procesos.FK_Turno', '=', 'turnos.id')
                ->join('tipos', 'procesos.FK_Tipo', '=', 'tipos.id')
                ->join('frecuencia_proceso', 'frecuencia_proceso.FK_Proceso', '=', 'procesos.id')
                ->join('frecuencias', 'frecuencia_proceso.FK_Frecuencia', '=', 'frecuencias.id')
                ->join('grupos', 'procesos.FK_Grupo', '=', 'grupos.id')
                ->join('paises', 'grupos.FK_Pais', '=', 'paises.id')
                ->where('tipos.id','=',$tipoUsuario)
                ->where('frecuencias.nombre', '=', 'Mensual')
                ->get();
        }
        $tipos= TipoR::orderBy('id','ASC')
            ->select('tipos.*')
            ->where('nombre','LIKE','%A1%')
            ->pluck('nombre','id');

        $responsable= TipoR::orderBy('id','ASC')
            ->select('tipos.*')
            ->where('nombre','LIKE','%A1%')
            ->where('id','!=',$tipoUsuario)
            ->pluck('nombre','id');

        $frecuencias = Frecuencia::pluck('nombre','id');

        $diaFrecuencia = FrecuenciaP::pluck('dia','id');

        $grupos = Grupo::pluck('nombre','id');

        $paises = Pais::pluck('nombre','id');

        $turnos = Turno::pluck('nombre','id');

        return \View::make('Procesos/listProcesoMensual', compact('procesosMensuales','responsable','tipos','frecuencias','diaFrecuencia','grupos','paises','turnos'));
    }

    public function indexSemanal()
    {
        $tipoUsuario = \Auth::user()->FK_Tipo;

        if($tipoUsuario=="1" || $tipoUsuario=="2" || $tipoUsuario=="7") {
            $procesosSemanales = FrecuenciaP::select(DB::raw('DISTINCT(FK_Proceso)'), 'procesos.*', 'grupos.nombre as Grupo', 'grupos.FK_Pais', 'turnos.nombre as Turno',
                'procesos.FK_Tipo', 'tipos.nombre as Tipo', 'paises.nombre as Pais', 'frecuencias.id as Frecuencia', 'frecuencia_proceso.FK_Frecuencia')
                ->join('procesos', 'frecuencia_proceso.FK_Proceso', '=', 'procesos.id')
                ->join('turnos', 'procesos.FK_Turno', '=', 'turnos.id')
                ->join('tipos', 'procesos.FK_Tipo', '=', 'tipos.id')
                ->join('grupos', 'procesos.FK_Grupo', '=', 'grupos.id')
                ->join('paises', 'grupos.FK_Pais', '=', 'paises.id')
                ->join('frecuencias', 'frecuencia_proceso.FK_Frecuencia', '=', 'frecuencias.id')
                ->where('frecuencias.nombre', '=', 'Semanal')
                ->get();
        }else{
            $procesosSemanales = FrecuenciaP::select(DB::raw('DISTINCT(FK_Proceso)'), 'procesos.*', 'grupos.nombre as Grupo', 'grupos.FK_Pais', 'turnos.nombre as Turno',
                'procesos.FK_Tipo', 'tipos.nombre as Tipo', 'paises.nombre as Pais', 'frecuencias.id as Frecuencia', 'frecuencia_proceso.FK_Frecuencia')
                ->join('procesos', 'frecuencia_proceso.FK_Proceso', '=', 'procesos.id')
                ->join('turnos', 'procesos.FK_Turno', '=', 'turnos.id')
                ->join('tipos', 'procesos.FK_Tipo', '=', 'tipos.id')
                ->join('grupos', 'procesos.FK_Grupo', '=', 'grupos.id')
                ->join('paises', 'grupos.FK_Pais', '=', 'paises.id')
                ->join('frecuencias', 'frecuencia_proceso.FK_Frecuencia', '=', 'frecuencias.id')
                ->where('frecuencias.nombre', '=', 'Semanal')
                ->where('tipos.id','=',$tipoUsuario)
                ->get();
        }
        $tipos= TipoR::orderBy('id','ASC')
            ->select('tipos.*')
            ->where('nombre','LIKE','%A1%')
            ->pluck('nombre','id');

        $responsable= TipoR::orderBy('id','ASC')
            ->select('tipos.*')
            ->where('nombre','LIKE','%A1%')
            ->where('id','!=',$tipoUsuario)
            ->pluck('nombre','id');

        $frecuencias = Frecuencia::pluck('nombre','id');

        $diaFrecuencia = FrecuenciaP::pluck('dia','id');

        $grupos = Grupo::pluck('nombre','id');

        $paises = Pais::pluck('nombre','id');

        $turnos = Turno::pluck('nombre','id');

        return \View::make('Procesos/listProcesoSemanal', compact('procesosSemanales','responsable','tipos','frecuencias','diaFrecuencia','grupos','paises','turnos'));
    }

    public function indexDemanda()
    {
        $tipoUsuario = \Auth::user()->FK_Tipo;

        if($tipoUsuario=="1" || $tipoUsuario=="2" || $tipoUsuario=="7") {
            $procesosDemanda = Proceso::orderBy('created_at', 'DESC')
                ->select('procesos.*', 'grupos.nombre as Grupo', 'grupos.FK_Pais', 'turnos.nombre as Turno',
                    'procesos.FK_Tipo', 'tipos.nombre as Tipo', 'frecuencia_proceso.FK_Frecuencia',
                    'frecuencias.id as Frecuencia', 'frecuencia_proceso.dia as dias_frecuencia', 'paises.nombre as Pais')
                ->join('turnos', 'procesos.FK_Turno', '=', 'turnos.id')
                ->join('tipos', 'procesos.FK_Tipo', '=', 'tipos.id')
                ->join('frecuencia_proceso', 'frecuencia_proceso.FK_Proceso', '=', 'procesos.id')
                ->join('frecuencias', 'frecuencia_proceso.FK_Frecuencia', '=', 'frecuencias.id')
                ->join('grupos', 'procesos.FK_Grupo', '=', 'grupos.id')
                ->join('paises', 'grupos.FK_Pais', '=', 'paises.id')
                ->where('frecuencias.nombre', '=', 'Demanda')
                ->get();
        }else{
            $procesosDemanda = Proceso::orderBy('created_at', 'DESC')
                ->select('procesos.*', 'grupos.nombre as Grupo', 'grupos.FK_Pais', 'turnos.nombre as Turno',
                    'procesos.FK_Tipo', 'tipos.nombre as Tipo', 'frecuencia_proceso.FK_Frecuencia',
                    'frecuencias.id as Frecuencia', 'frecuencia_proceso.dia as dias_frecuencia', 'paises.nombre as Pais')
                ->join('turnos', 'procesos.FK_Turno', '=', 'turnos.id')
                ->join('tipos', 'procesos.FK_Tipo', '=', 'tipos.id')
                ->join('frecuencia_proceso', 'frecuencia_proceso.FK_Proceso', '=', 'procesos.id')
                ->join('frecuencias', 'frecuencia_proceso.FK_Frecuencia', '=', 'frecuencias.id')
                ->join('grupos', 'procesos.FK_Grupo', '=', 'grupos.id')
                ->join('paises', 'grupos.FK_Pais', '=', 'paises.id')
                ->where('tipos.id','=',$tipoUsuario)
                ->where('frecuencias.nombre', '=', 'Demanda')
                ->get();
        }
        $tipos= TipoR::orderBy('id','ASC')
            ->select('tipos.*')
            ->where('nombre','LIKE','%A1%')
            ->pluck('nombre','id');

        $responsable= TipoR::orderBy('id','ASC')
            ->select('tipos.*')
            ->where('nombre','LIKE','%A1%')
            ->where('id','!=',$tipoUsuario)
            ->pluck('nombre','id');

        $frecuencias = Frecuencia::pluck('nombre','id');

        $diaFrecuencia = FrecuenciaP::pluck('dia','id');

        $grupos = Grupo::pluck('nombre','id');

        $paises = Pais::pluck('nombre','id');

        $turnos = Turno::pluck('nombre','id');


        return \View::make('Procesos/listProcesoDemanda', compact('procesosDemanda','tipos','responsable','frecuencias','diaFrecuencia','grupos','paises','turnos'));
    }


    public static function buscarGrupos($pais){

            $grupos=Grupo::orderBy('created_at','DESC')
                ->select('grupos.*','grupos.nombre as Grupo','grupos.id as idG','paises.id')
                ->join('paises','grupos.FK_Pais','=','paises.id')
                ->where('paises.id', '=', $pais)
                ->pluck('Grupo','idG');
        return $grupos;
    }

    public static function buscarInformacion(Request $request){

        if($request->ajax()){
            $Procesos = Proceso::orderBy('id','DESC')
                ->select(DB::raw("addtime(procesos.Horario,procesos.t_ejecucion) as 'hora_aprox'"),'procesos.sysdate as Sysdate',
                    'tipos.nombre as Responsable','procesos.id','procesos.plataforma as Plataforma','grupos.nombre as Grupo',
                    'paises.nombre as Pais')
                ->join('tipos','procesos.FK_Tipo','=','tipos.id')
                ->join('grupos','procesos.FK_Grupo','=','grupos.id')
                ->join('paises','grupos.FK_Pais','=','paises.id')
                ->where('procesos.id', '=', $request->proceso)
                ->get();

            foreach ($Procesos as $proceso){

                $procesos[] = array(
                    'Sysdate' => $proceso->Sysdate,
                    'Hora'=>$proceso->hora_aprox,
                    'Responsable'=>$proceso->Responsable,
                    'Plataforma'=>$proceso->Plataforma,
                    'Grupo'=>$proceso->Grupo,
                    'Pais'=>$proceso->Pais
                );
            }
            return json_encode($procesos);
        }

    }


    public static function buscarGrupoPais(Request $request){

        if($request->ajax()){
            $pais=Grupo::orderBy('created_at','DESC')
                ->select('grupos.*','grupos.nombre as Grupo','grupos.id as idG','paises.id')
                ->join('paises','grupos.FK_Pais','=','paises.id')
                ->where('paises.id', '=', $request->pais)
                ->pluck('Grupo','idG');
            return json_encode($pais);
        }
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

        $frecuencias = Frecuencia::orderBy('id','ASC')->select('nombre','id')->get();

        $paises = Pais::orderBy('id','ASC')->select('id','nombre')->get();

        $turnos = Turno::orderBy('id','ASC')->select('nombre','id')->get();

        return \View::make('Procesos/NewProceso', compact('tipos','frecuencias','paises','turnos'));
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

            $buscarProceso = Proceso::orderBy('id','ASC')
                ->select('procesos.*')
                ->where('procesos.nombre', '=', $request->nombre)
                ->where('procesos.plataforma','=',$request->plataforma)
                ->where('procesos.FK_Grupo','=',$request->FK_Grupo)
                ->get();

            if($buscarProceso=="[]"){
                $Proceso = new Proceso();
                $Proceso->nombre = $request->nombre;
                $Proceso->plataforma = $request->plataforma;
                $Proceso->job = $request->job;
                $Proceso->servidor = $request->servidor;
                $Proceso->catalogo = $request->catalogo;
                $Proceso->tarea_programada = $request->t_programada;
                $Proceso->prerequisitos = $request->prerequisitos;
                $Proceso->horario = $request->horario;
                $Proceso->t_ejecucion = $request->t_ejecucion;
                $Proceso->sysdate = $request->sysdate;
                $Proceso->semaforo = $request->semaforo;
                $Proceso->estado="Activo";
                $Proceso->FK_Grupo = $request->FK_Grupo;
                $Proceso->FK_Turno = $request->FK_Turno;
                $Proceso->FK_Tipo = $request->FK_Tipo;
                $Proceso->save();

            $this->registrarFrecuenciaProceso($request->nombre,$request->plataforma,$request->FK_Frecuencia,$request->tamano,
            $request->diasFrecuencia,$request->tipoEntregable, $request->rutaEntregable);

                Session::flash('flash_message', 'Proceso registrado exitosamente.');
            }else if($buscarProceso!="[]"){
                $Proceso = new Proceso();
                Session::flash('error_message', 'El proceso ya se encuentra registrado');
            }
        }
        return redirect()->back();
    }


    public function registrarFrecuenciaProceso($nombre,$plataforma,$frecuencia,$tamano,$dias,$tipo,$ruta)
    {
        $this->registrarEntregable($nombre,$plataforma,$tipo, $ruta);
        $idProceso=null;
        $Proceso = Proceso::orderBy('id','ASC')
            ->select('procesos.*')
            ->where('procesos.nombre', '=', $nombre)
            ->where('procesos.plataforma','=',$plataforma)
            ->get();

        if($Proceso!="[]"){
            foreach ($Proceso as $proceso){
                $idProceso=$proceso->id;

                for ($i = 0; $i <= $tamano; $i++) {
                    $PFrecuencia = new FrecuenciaP();
                    $PFrecuencia->dia = $dias[$i];
                    $PFrecuencia->FK_Frecuencia = $frecuencia;
                    $PFrecuencia->FK_Proceso = $idProceso;
                    $PFrecuencia->save();
                }

            }
        }
    }

    public function registrarEntregable($nombre, $plataforma,$tipo,$ruta)
    {

        $idProceso=null;
        $Proceso = Proceso::orderBy('id','ASC')
            ->select('procesos.*')
            ->where('procesos.nombre', '=', $nombre)
            ->where('procesos.plataforma','=',$plataforma)
            ->get();

        if($Proceso!="[]"){
            foreach ($Proceso as $proceso){
                $idProceso=$proceso->id;

                $buscarEntregable = Entregable::orderBy('id','ASC')
                    ->select('entregables.*')
                    ->where('entregables.tipo', '=', $tipo)
                    ->where('entregables.ruta','=',$ruta)
                    ->get();

                if($buscarEntregable=="[]"){
                    $Entregable = new Entregable();
                    $Entregable->tipo = $tipo;
                    $Entregable->ruta = $ruta;
                    $Entregable->estado = "Activo";
                    $Entregable->save();
                }


                $entregable=Entregable::orderBy('id','ASC')
                    ->select('entregables.id')
                    ->where('entregables.tipo', '=',$tipo)
                    ->where('entregables.ruta','=',$ruta)
                    ->get();

                if($entregable!="[]"){
                     foreach ($entregable as $Entregable){
                         $idEntregable=$Entregable->id;
                         $Asignacion = new Asignacion();
                         $Asignacion->FK_Proceso = $idProceso;
                         $Asignacion->FK_Entregable = $idEntregable;
                         $Asignacion->save();
                     }
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
        $Procesos = Proceso::find($id);
        return\View::make('Proceso/ModalCambioEstado', compact('Procesos'));

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
        $Proceso = Proceso::find($request->id);
        $Proceso ->estado = $request ->estado;
        $Proceso ->justificacion = $request ->justificacion;
        $Proceso -> save();

        $entregables = Proceso::find($request->id)
            ->select('procesos.nombre as Proceso', 'entregables.tipo as Tipo', 'entregables.ruta as Ruta', 'entregables.id as idEntregable')
            ->join('asignacion', 'asignacion.FK_Proceso', '=', 'procesos.id')
            ->join('entregables', 'asignacion.FK_Entregable', '=', 'entregables.id')
            ->where('asignacion.FK_Proceso', '=', $request->id)
            ->get();

        foreach ($entregables as $entregable){
            $Entregable = Entregable::find($entregable->idEntregable);
            $Entregable ->estado = $request ->estado;
            $Entregable ->estado = $request ->estado;
            $Entregable -> save();
        }

        return redirect()->back();
    }


    public function actualizarProceso(Request $request){

        if($request->ajax()){

            $buscarProceso = Proceso::orderBy('id','ASC')
                ->select('procesos.*')
                ->where('procesos.nombre', '=', $request->nombre)
                ->where('procesos.plataforma','=',$request->plataforma)
                ->where('procesos.FK_Grupo','=',$request->FK_Grupo)
                ->get();

            $proceso = Proceso::find($request->id);
            if($buscarProceso=="[]"){
                $proceso->nombre = $request->nombre;
                $proceso->plataforma = $request->plataforma;
            }
            $proceso->job = $request->job;
            $proceso->servidor = $request->servidor;
            $proceso->catalogo = $request->catalogo;
            $proceso->tarea_programada = $request->t_programada;
            $proceso->prerequisitos = $request->prerequisitos;
            $proceso->horario = $request->horario;
            $proceso->t_ejecucion = $request->t_ejecucion;
            $proceso->sysdate = $request->sysdate;
            $proceso->semaforo = $request->semaforo;
            $proceso->justificacion=$request->justificacion;
            if($buscarProceso=="[]"){
                $proceso->FK_Grupo = $request->FK_Grupo;
            }
            $proceso->FK_Turno = $request->FK_Turno;
            $proceso->FK_Tipo = $request->FK_Tipo;
            $proceso->save();

            $this->actualizarFrecuenciaP($request->id,$request->FK_Frecuencia,$request->tamano,$request->diasFrecuencia);
        }
        return redirect()->back();
    }

    public function actualizarFrecuenciaP($idProceso,$frecuencia,$tamano, $dias)
    {

        $frecuenciaAn = null;
        $frecuenciaUP = null;

        $Proceso = Proceso::find($idProceso)
            ->select('frecuencia_proceso.*','frecuencia_proceso.id as idP', 'frecuencias.nombre as FK_Frecuencia')
            ->join('frecuencia_proceso', 'frecuencia_proceso.FK_Proceso', '=', 'procesos.id')
            ->join('frecuencias', 'frecuencia_proceso.FK_Frecuencia', '=', 'frecuencias.id')
            ->where('procesos.id', '=', $idProceso)
            ->get();

        foreach ($Proceso as $proceso) {
            $frecuenciaAn = $proceso->FK_Frecuencia;
            $frecuenciaUP = $frecuencia;
            $item = array('id'=>$proceso->idP);
            $items[] = $item;
        }

        /*Validacion si frecuencia proceso en BD es diaria y frecuencia a actualizar es Semanal*/
        if($frecuenciaAn=="Diaria" && $frecuenciaUP=="2"){

            foreach ($Proceso as $frecuenciaP){
                $FrecuenP=FrecuenciaP::find($frecuenciaP->id);
                $FrecuenP->delete();
                for ($i = 0; $i <= $tamano; $i++) {

                    $PFrecuencia = new FrecuenciaP();
                    $PFrecuencia->dia = $dias[$i];
                    $PFrecuencia->FK_Frecuencia = $frecuenciaUP;
                    $PFrecuencia->FK_Proceso = $idProceso;
                    $PFrecuencia->save();
                }
            }
        }else if($frecuenciaAn=="Diaria" && $frecuenciaUP!="2"){
            foreach ($Proceso as $frecuenciaP) {
                for ($i = 0; $i <= $tamano; $i++) {
                    $FrecuenP = FrecuenciaP::find($frecuenciaP->id);
                    $FrecuenP->dia=$dias[$i];
                    $FrecuenP->FK_Frecuencia = $frecuenciaUP;
                    $FrecuenP->FK_Proceso = $idProceso;
                    $FrecuenP->save();
                }
            }
        }

        /*Validacion si frecuencia proceso en BD es demanda y frecuencia a actualizar es Semanal*/
        if($frecuenciaAn=="Demanda" && $frecuenciaUP=="2"){
            foreach ($Proceso as $frecuenciaP){
                $FrecuenP=FrecuenciaP::find($frecuenciaP->id);
                $FrecuenP->delete();
                for ($i = 0; $i <= $tamano; $i++) {

                    $PFrecuencia = new FrecuenciaP();
                    $PFrecuencia->dia = $dias[$i];
                    $PFrecuencia->FK_Frecuencia = $frecuenciaUP;
                    $PFrecuencia->FK_Proceso = $idProceso;
                    $PFrecuencia->save();
                }
            }

        }else if($frecuenciaAn=="Demanda" && $frecuenciaUP!="2"){
            foreach ($Proceso as $frecuenciaP) {
                for ($i = 0; $i <= $tamano; $i++) {
                    $FrecuenP = FrecuenciaP::find($frecuenciaP->id);
                    $FrecuenP->dia=$dias[$i];
                    $FrecuenP->FK_Frecuencia = $frecuenciaUP;
                    $FrecuenP->FK_Proceso = $idProceso;
                    $FrecuenP->save();
                }
            }
        }

        /*Validacion si frecuencia proceso en BD es mensual y frecuencia a actualizar es Semanal*/
        if($frecuenciaAn=="Mensual" && $frecuenciaUP=="2"){
            foreach ($Proceso as $frecuenciaP){
                $FrecuenP=FrecuenciaP::find($frecuenciaP->id);
                $FrecuenP->delete();
                for ($i = 0; $i <= $tamano; $i++) {

                    $PFrecuencia = new FrecuenciaP();
                    $PFrecuencia->dia = $dias[$i];
                    $PFrecuencia->FK_Frecuencia = $frecuenciaUP;
                    $PFrecuencia->FK_Proceso = $idProceso;
                    $PFrecuencia->save();
                }
            }

        }else if($frecuenciaAn=="Mensual" && $frecuenciaUP!="2") {
            foreach ($Proceso as $frecuenciaP) {
                for ($i = 0; $i <= $tamano; $i++) {
                    $FrecuenP = FrecuenciaP::find($frecuenciaP->id);
                    $FrecuenP->dia = $dias[$i];
                    $FrecuenP->FK_Frecuencia = $frecuenciaUP;
                    $FrecuenP->FK_Proceso = $idProceso;
                    $FrecuenP->save();
                }
            }
        }

        /*Validacion si frecuencia proceso en BD es semanal y frecuencia a actualizar es diaria, semanal o mensual*/
        if ($frecuenciaAn == "Semanal" && $frecuenciaUP != "2") {
            foreach ($Proceso as $frecuenciaP) {
                $FrecuenP = FrecuenciaP::find($frecuenciaP->id);
                $FrecuenP->delete();
            }
            for ($i = 0; $i <= $tamano; $i++) {

                $PFrecuencia = new FrecuenciaP();
                $PFrecuencia->dia = $dias[$i];
                $PFrecuencia->FK_Frecuencia = $frecuenciaUP;
                $PFrecuencia->FK_Proceso = $idProceso;
                $PFrecuencia->save();
            }
        }else if($frecuenciaAn == "Semanal" && $frecuenciaUP == "2"){

            if($tamano!="0"){
                foreach ($Proceso as $frecuenciaP) {
                    $FrecuenP = FrecuenciaP::find($frecuenciaP->id);
                    $FrecuenP->delete();
                }
                for ($i = 0; $i <= $tamano; $i++) {

                    $PFrecuencia = new FrecuenciaP();
                    $PFrecuencia->dia = $dias[$i];
                    $PFrecuencia->FK_Frecuencia = $frecuenciaUP;
                    $PFrecuencia->FK_Proceso = $idProceso;
                    $PFrecuencia->save();
                }
            }
        }
    }

    public function actualizarResponsable(Request $request){

        $Proceso = Proceso::find($request->id);
        $Proceso ->FK_Tipo = $request ->FK_Tipo;
        $Proceso -> save();

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
        $Proceso=Proceso::find($id);
        $Proceso->delete();
        return redirect()->back();
    }

      public function search(Request $request)
    {
        $procesos = Proceso::where('nombre','like','%'.$request->nombre.'%')->paginate(5);
        return \View::make('Proceso/listProceso', compact('procesos'));
    }
}




