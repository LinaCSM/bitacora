<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Proceso as Proceso;
use App\Models\Entregas as Entregas;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
class MinutogramaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $tipoUsuario = \Auth::user()->FK_Tipo;

        $procesos = Proceso::orderBy('created_at', 'DESC')
            ->select('procesos.*', 'frecuencia_proceso.dia as dias_ejecucion', 'asignacion.id as FK_Asignacion',
                'entregables.tipo as tipoEntregable','turnos.nombre as FK_Turno')
            ->join('turnos', 'procesos.FK_Turno', '=', 'turnos.id')
            ->join('frecuencia_proceso', 'frecuencia_proceso.FK_Proceso', '=', 'procesos.id')
            ->join('asignacion', 'asignacion.FK_Proceso', '=', 'procesos.id')
            ->join('entregables', 'asignacion.FK_Entregable', '=', 'entregables.id')
            ->get();

        $procesosMañana = Proceso::orderBy('horario', 'ASC')
        ->select('procesos.*', 'grupos.nombre as FK_Grupo', 'grupos.FK_Pais', 'turnos.nombre as FK_Turno',
            'procesos.FK_Tipo', 'tipos.nombre as FK_Tipo', 'paises.nombre as FK_Pais', 'frecuencia_proceso.FK_Frecuencia',
            'frecuencias.nombre as FK_Frecuencia')
        ->join('turnos', 'procesos.FK_Turno', '=', 'turnos.id')
        ->join('frecuencia_proceso', 'frecuencia_proceso.FK_Proceso', '=', 'procesos.id')
        ->join('frecuencias', 'frecuencia_proceso.FK_Frecuencia', '=', 'frecuencias.id')
        ->join('tipos', 'procesos.FK_Tipo', '=', 'tipos.id')
        ->join('grupos', 'procesos.FK_Grupo', '=', 'grupos.id')
        ->join('paises', 'grupos.FK_Pais', '=', 'paises.id')
        ->where('turnos.nombre', '=', 'Manana')
        ->where('tipos.id','=',$tipoUsuario)
        ->where('procesos.estado', '=', 'Activo')
        ->where('frecuencias.nombre', '=', 'Diaria')
        ->get();

        $procesosTarde = Proceso::orderBy('created_at', 'DESC')
            ->select('procesos.*', 'grupos.nombre as FK_Grupo', 'grupos.FK_Pais', 'turnos.nombre as FK_Turno',
                'procesos.FK_Tipo', 'tipos.nombre as FK_Tipo', 'paises.nombre as FK_Pais', 'frecuencia_proceso.FK_Frecuencia',
                'frecuencias.nombre as FK_Frecuencia')
            ->join('turnos', 'procesos.FK_Turno', '=', 'turnos.id')
            ->join('frecuencia_proceso', 'frecuencia_proceso.FK_Proceso', '=', 'procesos.id')
            ->join('frecuencias', 'frecuencia_proceso.FK_Frecuencia', '=', 'frecuencias.id')
            ->join('tipos', 'procesos.FK_Tipo', '=', 'tipos.id')
            ->join('grupos', 'procesos.FK_Grupo', '=', 'grupos.id')
            ->join('paises', 'grupos.FK_Pais', '=', 'paises.id')
            ->where('turnos.nombre', '=', 'Tarde')
            ->where('tipos.id','=',$tipoUsuario)
            ->where('procesos.estado', '=', 'Activo')
            ->where('frecuencias.nombre', '=', 'Diaria')
            ->get();

        $procesosNoche = Proceso::orderBy('created_at', 'DESC')
            ->select('procesos.*', 'grupos.nombre as FK_Grupo', 'grupos.FK_Pais', 'turnos.nombre as FK_Turno', 'procesos.FK_Tipo', 'tipos.nombre as FK_Tipo',
                'paises.nombre as FK_Pais', 'frecuencia_proceso.FK_Frecuencia', 'frecuencias.nombre as FK_Frecuencia')
            ->join('turnos', 'procesos.FK_Turno', '=', 'turnos.id')
            ->join('frecuencia_proceso', 'frecuencia_proceso.FK_Proceso', '=', 'procesos.id')
            ->join('frecuencias', 'frecuencia_proceso.FK_Frecuencia', '=', 'frecuencias.id')
            ->join('tipos', 'procesos.FK_Tipo', '=', 'tipos.id')
            ->join('grupos', 'procesos.FK_Grupo', '=', 'grupos.id')
            ->join('paises', 'grupos.FK_Pais', '=', 'paises.id')
            ->where('turnos.nombre', '=', 'Noche')
            ->where('tipos.id','=',$tipoUsuario)
            ->where('procesos.estado', '=', 'Activo')
            ->where('frecuencias.nombre', '=', 'Diaria')
            ->get();

        $entregas = Entregas::orderBy('created_at', 'DESC')
            ->select('entregas.*', 'procesos.nombre as PNombre','procesos.job as PJob','procesos.horario as PHorario',
                'procesos.id as Pid', 'entregables.tipo as PEntregable','turnos.nombre as PTurno')
            ->join('asignacion', 'asignacion.id', '=', 'entregas.FK_Asignacion')
            ->join('procesos', 'procesos.id', '=', 'asignacion.FK_Proceso')
            ->join('entregables', 'entregables.id', '=', 'asignacion.FK_Entregable')
            ->join('turnos', 'procesos.FK_Turno', '=', 'turnos.id')
            ->get();

        return view('Minutograma/MinutogramaDiario', compact('procesosMañana', 'procesosTarde', 'procesosNoche', 'procesos', 'entregas'));
    }

    public function indexMensual()
    {
        $tipoUsuario = \Auth::user()->FK_Tipo;

        $procesos = Proceso::orderBy('created_at', 'DESC')
            ->select('procesos.*', 'frecuencia_proceso.dia as dias_ejecucion', 'asignacion.id as FK_Asignacion',
                'entregables.tipo as tipoEntregable')
            ->join('frecuencia_proceso', 'frecuencia_proceso.FK_Proceso', '=', 'procesos.id')
            ->join('asignacion', 'asignacion.FK_Proceso', '=', 'procesos.id')
            ->join('entregables', 'asignacion.FK_Entregable', '=', 'entregables.id')
            ->get();

        $procesosMensuales = Proceso::orderBy('created_at', 'DESC')
            ->select('procesos.*', 'grupos.nombre as FK_Grupo', 'grupos.FK_Pais',
                'tipos.nombre as FK_Tipo', 'paises.nombre as FK_Pais',
                'frecuencias.nombre as FK_Frecuencia')
            ->join('frecuencia_proceso', 'frecuencia_proceso.FK_Proceso', '=', 'procesos.id')
            ->join('frecuencias', 'frecuencia_proceso.FK_Frecuencia', '=', 'frecuencias.id')
            ->join('tipos', 'procesos.FK_Tipo', '=', 'tipos.id')
            ->join('grupos', 'procesos.FK_Grupo', '=', 'grupos.id')
            ->join('paises', 'grupos.FK_Pais', '=', 'paises.id')
            ->where('procesos.estado','=','Activo')
            ->where('tipos.id','=',$tipoUsuario)
            ->where('frecuencias.nombre','=','Mensual')
            ->where('frecuencia_proceso.dia','=',Carbon::now()->day)
            ->get();

        $entregas = Entregas::orderBy('created_at', 'DESC')
            ->select('entregas.*', 'procesos.nombre as PNombre','procesos.job as PJob','procesos.horario as PHorario',
                'procesos.id as Pid', 'entregables.tipo as PEntregable')
            ->join('asignacion', 'asignacion.id', '=', 'entregas.FK_Asignacion')
            ->join('procesos', 'procesos.id', '=', 'asignacion.FK_Proceso')
            ->join('entregables', 'entregables.id', '=', 'asignacion.FK_Entregable')
            ->get();

        return view('Minutograma/MinutogramaMensual', compact('procesos','procesosMensuales','entregas'));
    }

    public function indexOficina()
    {
        $tipoUsuario = \Auth::user()->FK_Tipo;

        $procesos = Proceso::orderBy('created_at', 'DESC')
            ->select('procesos.*', 'frecuencia_proceso.dia as dias_ejecucion', 'asignacion.id as FK_Asignacion',
                'entregables.tipo as tipoEntregable')
            ->join('frecuencia_proceso', 'frecuencia_proceso.FK_Proceso', '=', 'procesos.id')
            ->join('asignacion', 'asignacion.FK_Proceso', '=', 'procesos.id')
            ->join('entregables', 'asignacion.FK_Entregable', '=', 'entregables.id')
            ->get();

        $procesosOficina = Proceso::orderBy('created_at', 'DESC')
            ->select('procesos.*', 'grupos.nombre as FK_Grupo', 'grupos.FK_Pais',
                'tipos.nombre as FK_Tipo', 'paises.nombre as FK_Pais',
                'frecuencias.nombre as FK_Frecuencia')
            ->join('frecuencia_proceso', 'frecuencia_proceso.FK_Proceso', '=', 'procesos.id')
            ->join('frecuencias', 'frecuencia_proceso.FK_Frecuencia', '=', 'frecuencias.id')
            ->join('tipos', 'procesos.FK_Tipo', '=', 'tipos.id')
            ->join('grupos', 'procesos.FK_Grupo', '=', 'grupos.id')
            ->join('paises', 'grupos.FK_Pais', '=', 'paises.id')
            ->where('procesos.estado','=','Activo')
            ->where('tipos.id','=',$tipoUsuario)
            ->where('frecuencias.nombre', '=', 'Diaria')
            ->get();

        $entregas = Entregas::orderBy('created_at', 'DESC')
            ->select('entregas.*', 'procesos.nombre as PNombre','procesos.job as PJob','procesos.horario as PHorario',
                'procesos.id as Pid', 'entregables.tipo as PEntregable')
            ->join('asignacion', 'asignacion.id', '=', 'entregas.FK_Asignacion')
            ->join('procesos', 'procesos.id', '=', 'asignacion.FK_Proceso')
            ->join('entregables', 'entregables.id', '=', 'asignacion.FK_Entregable')
            ->get();

        return view('Minutograma/MinutogramaOficina', compact('procesos','procesosOficina','entregas'));
    }



    public function indexSemanal()
    {
        setlocale(LC_TIME, config('app.locale'));/*Fechas en español*/

        $tipoUsuario = \Auth::user()->FK_Tipo;

        $procesos = Proceso::orderBy('created_at', 'DESC')
            ->select('procesos.*','frecuencia_proceso.dia as dias_ejecucion', 'asignacion.id as FK_Asignacion',
                'entregables.tipo as tipoEntregable')
            ->join('frecuencia_proceso', 'frecuencia_proceso.FK_Proceso', '=', 'procesos.id')
            ->join('asignacion', 'asignacion.FK_Proceso', '=', 'procesos.id')
            ->join('entregables', 'asignacion.FK_Entregable', '=', 'entregables.id')
            ->get();

        $procesosSemanales = Proceso::orderBy('created_at', 'DESC')
            ->select(DB::raw('DISTINCT(FK_Proceso)'),'procesos.*', 'grupos.nombre as FK_Grupo', 'grupos.FK_Pais',
                'tipos.nombre as FK_Tipo', 'paises.nombre as FK_Pais',
                'frecuencias.nombre as FK_Frecuencia')
            ->join('frecuencia_proceso', 'frecuencia_proceso.FK_Proceso', '=', 'procesos.id')
            ->join('frecuencias', 'frecuencia_proceso.FK_Frecuencia', '=', 'frecuencias.id')
            ->join('tipos', 'procesos.FK_Tipo', '=', 'tipos.id')
            ->join('grupos', 'procesos.FK_Grupo', '=', 'grupos.id')
            ->join('paises', 'grupos.FK_Pais', '=', 'paises.id')
            ->where('procesos.estado','=','Activo')
            ->where('tipos.id','=',$tipoUsuario)
            ->where('frecuencias.nombre','=','Semanal')
            ->where(function ($query){
                $query->where('frecuencia_proceso.dia', '=', Carbon::now()->day)
                    ->orWhere('frecuencia_proceso.dia', '=', ucfirst(Carbon::now()->formatLocalized('%A')));
            })

            ->get();
        //ucfirst(Carbon::now()->formatLocalized('%A'))->Trae nombre del dia actual de la semana.

        $entregas = Entregas::orderBy('created_at', 'DESC')
            ->select('entregas.*', 'procesos.nombre as PNombre','procesos.job as PJob','procesos.horario as PHorario',
                'procesos.id as Pid', 'entregables.tipo as PEntregable')
            ->join('asignacion', 'asignacion.id', '=', 'entregas.FK_Asignacion')
            ->join('procesos', 'procesos.id', '=', 'asignacion.FK_Proceso')
            ->join('entregables', 'entregables.id', '=', 'asignacion.FK_Entregable')
            ->get();

        return view('Minutograma/MinutogramaSemanal', compact('procesos','procesosSemanales','entregas'));
    }

    public function indexDemanda()
    {
        $tipoUsuario = \Auth::user()->FK_Tipo;

        $procesos = Proceso::orderBy('created_at', 'DESC')
            ->select('procesos.*','frecuencia_proceso.dia as dias_ejecucion', 'asignacion.id as FK_Asignacion',
                'entregables.tipo as tipoEntregable')
            ->join('frecuencia_proceso', 'frecuencia_proceso.FK_Proceso', '=', 'procesos.id')
            ->join('asignacion', 'asignacion.FK_Proceso', '=', 'procesos.id')
            ->join('entregables', 'asignacion.FK_Entregable', '=', 'entregables.id')
            ->get();

        $procesosDemanda = Proceso::orderBy('created_at', 'DESC')
            ->select(DB::raw('DISTINCT(FK_Proceso)'),'procesos.*', 'grupos.nombre as FK_Grupo', 'grupos.FK_Pais',
                'tipos.nombre as FK_Tipo', 'paises.nombre as FK_Pais',
                'frecuencias.nombre as FK_Frecuencia')
            ->join('frecuencia_proceso', 'frecuencia_proceso.FK_Proceso', '=', 'procesos.id')
            ->join('frecuencias', 'frecuencia_proceso.FK_Frecuencia', '=', 'frecuencias.id')
            ->join('tipos', 'procesos.FK_Tipo', '=', 'tipos.id')
            ->join('grupos', 'procesos.FK_Grupo', '=', 'grupos.id')
            ->join('paises', 'grupos.FK_Pais', '=', 'paises.id')
            ->where('procesos.estado','=','Activo')
            ->where('tipos.id','=',$tipoUsuario)
            ->where('frecuencias.nombre','=','Demanda')
            ->get();

        $entregas = Entregas::orderBy('created_at', 'DESC')
            ->select('entregas.*', 'procesos.nombre as PNombre','procesos.job as PJob','procesos.horario as PHorario',
                'procesos.id as Pid', 'entregables.tipo as PEntregable')
            ->join('asignacion', 'asignacion.id', '=', 'entregas.FK_Asignacion')
            ->join('procesos', 'procesos.id', '=', 'asignacion.FK_Proceso')
            ->join('entregables', 'entregables.id', '=', 'asignacion.FK_Entregable')
            ->get();

        return view('Minutograma/MinutogramaDemanda', compact('procesos','procesosDemanda','entregas'));
    }

    public static function horaActual()
    {
        $hora = Carbon::now()->toTimeString();
        return $hora;
    }


    public static function buscarEntregables($id)
    {
        $entregables = Proceso::find($id)
            ->select('procesos.nombre as Proceso','procesos.horario as Horario', 'entregables.tipo as Tipo',
                'entregables.ruta as Ruta', 'asignacion.id as Asignacion', 'entregables.estado as Estado')
            ->join('asignacion', 'asignacion.FK_Proceso', '=', 'procesos.id')
            ->join('entregables', 'asignacion.FK_Entregable', '=', 'entregables.id')
            ->where('asignacion.FK_Proceso', '=', $id)
            ->get();

        return $entregables;
    }


    public static function buscarEntrega($id)
    {
        $entrega = Proceso::find($id)
            ->select('procesos.id', 'entregas.*', 'entregas.estado', 'entregas.id as EntregaID',
                'entregas.hora_final as HoraFin', 'asignacion.id as FK_Asignacion')
            ->join('asignacion', 'asignacion.FK_Proceso', '=', 'procesos.id')
            ->join('entregas', 'entregas.FK_Asignacion', '=', 'asignacion.id')
            ->where('asignacion.FK_Proceso', '=', $id)
            ->where('entregas.fecha','=',Carbon::now()->toDateString())
            ->get();

        return $entrega;
    }

    public static function buscarEntregaNoche($id)
    {
        $entregaNoche = Proceso::find($id)
            ->select('procesos.id', 'entregas.*', 'entregas.estado', 'entregas.id as EntregaID',
                'entregas.hora_final as HoraFin','entregas.fecha as Fecha', 'asignacion.id as FK_Asignacion')
            ->join('asignacion', 'asignacion.FK_Proceso', '=', 'procesos.id')
            ->join('entregas', 'entregas.FK_Asignacion', '=', 'asignacion.id')
            ->where('asignacion.FK_Proceso', '=', $id)
            ->where(function ($query){
                $query->where('entregas.fecha', '=', Carbon::now()->toDateString())
                    ->orWhere('entregas.fecha', '=', Carbon::yesterday()->toDateString());
            })
            ->get();

        return $entregaNoche;
    }

    public static function buscarEntregaSemaforo($id)
    {
        $entrega = Proceso::find($id)
            ->select('procesos.id', 'entregas.*', 'entregas.estado', 'entregas.id as EntregaID',
                'entregas.hora_final as HoraFin', 'asignacion.id as FK_Asignacion')
            ->join('asignacion', 'asignacion.FK_Proceso', '=', 'procesos.id')
            ->join('entregas', 'entregas.FK_Asignacion', '=', 'asignacion.id')
            ->where('asignacion.FK_Proceso', '=', $id)
            ->where('entregas.fecha','=',Carbon::now()->toDateString())
            ->where('entregas.estado','!=',"En ejecucion")
            ->get();

        return $entrega;
    }

    public static function buscarEntregaSemaforoNoche($id)
    {
        $entrega = Proceso::find($id)
            ->select('procesos.id', 'entregas.*', 'entregas.estado', 'entregas.id as EntregaID',
                'entregas.hora_final as HoraFin', 'asignacion.id as FK_Asignacion')
            ->join('asignacion', 'asignacion.FK_Proceso', '=', 'procesos.id')
            ->join('entregas', 'entregas.FK_Asignacion', '=', 'asignacion.id')
            ->where('asignacion.FK_Proceso', '=', $id)
            ->where('entregas.fecha','=',Carbon::yesterday()->toDateString())
            ->where('entregas.estado','!=',"En ejecucion")
            ->get();

        return $entrega;
    }

    public static function prueba(){
        //$fechaActual=Carbon::now();
      //  setlocale(LC_TIME, config('app.locale'));
        $fecha="asd";
        //htmlentities($fecha, ENT_QUOTES, "UTF-8");
       // $resul=str_replace(array('á','é'),array('a','e'),);

        $prueba= Carbon::now()->startOfMonth()->toDateString();
        $prueba2=Carbon::now()->endOfMonth()->toDateString();
        return $prueba."/".$prueba2;

    }

    public static function buscarDiasEjecucion($id)
    {
        $diasEjecucion = Proceso::find($id)
            ->select('procesos.nombre as Proceso','frecuencia_proceso.dia as Dia')
            ->join('frecuencia_proceso', 'frecuencia_proceso.FK_Proceso', '=', 'procesos.id')
            ->join('frecuencias', 'frecuencia_proceso.FK_Frecuencia', '=', 'frecuencias.id')
            ->where('frecuencia_proceso.FK_Proceso', '=', $id)->get();
        return $diasEjecucion;
    }

    public static function buscarEntregasMañana($id)
    {
        $entregasTarde = Proceso::find($id)
            ->select('procesos.id', 'entregas.*', 'entregas.estado as Estado', 'entregas.id as EntregaID',
                'entregas.hora_final as HoraFin', 'asignacion.id as FK_Asignacion')
            ->join('asignacion', 'asignacion.FK_Proceso', '=', 'procesos.id')
            ->join('entregas', 'entregas.FK_Asignacion', '=', 'asignacion.id')
            ->where('asignacion.FK_Proceso', '=', $id)
            ->where('entregas.fecha','=',Carbon::now()->toDateString())
            ->get();
        return $entregasTarde;
    }

    public static function buscarEntregasTarde($id)
    {
        /*Muestra procesos entregados del dia actual desde 6 am a 11:59 pm*/
        if(Carbon::now()->toTimeString()>='06:00:00'  && Carbon::now()->toTimeString()<='23:59:59') {
            $entregasTarde = Proceso::find($id)
                ->select('procesos.id', 'entregas.*', 'entregas.estado as Estado', 'entregas.id as EntregaID',
                    'entregas.hora_final as HoraFin', 'asignacion.id as FK_Asignacion')
                ->join('asignacion', 'asignacion.FK_Proceso', '=', 'procesos.id')
                ->join('entregas', 'entregas.FK_Asignacion', '=', 'asignacion.id')
                ->where('asignacion.FK_Proceso', '=', $id)
                ->where('entregas.fecha','=',Carbon::now()->toDateString())
                ->get();
            return $entregasTarde;
        }

        /*Muestra procesos entregados del dia anterior desde media noche a 05:59 am*/
        else if(Carbon::now()->toTimeString()>='00:00:00' && Carbon::now()->toTimeString()<='05:59:59') {

            $entregasTardeAyer = Proceso::find($id)
                ->select('procesos.id', 'entregas.*', 'entregas.estado as Estado', 'entregas.id as EntregaID',
                    'entregas.hora_final as HoraFin', 'asignacion.id as FK_Asignacion')
                ->join('asignacion', 'asignacion.FK_Proceso', '=', 'procesos.id')
                ->join('turnos', 'turnos.id', '=', 'procesos.FK_Turno')
                ->join('entregas', 'entregas.FK_Asignacion', '=', 'asignacion.id')
                ->where('entregas.fecha', '=',Carbon::yesterday()->toDateString())
                ->where('asignacion.FK_Proceso', '=', $id)
                ->where('turnos.nombre', '=', 'Tarde')
                ->where('entregas.estado','=', 'En ejecucion');

            $entregasTarde = Proceso::find($id)
                ->select('procesos.id', 'entregas.*', 'entregas.estado as Estado', 'entregas.id as EntregaID',
                    'entregas.hora_final as HoraFin', 'asignacion.id as FK_Asignacion')
                ->join('asignacion', 'asignacion.FK_Proceso', '=', 'procesos.id')
                ->join('entregas', 'entregas.FK_Asignacion', '=', 'asignacion.id')
                ->where('asignacion.FK_Proceso', '=', $id)
                ->where('entregas.fecha', '=', Carbon::now()->toDateString())
                ->union($entregasTardeAyer)
                ->get();


            return $entregasTarde;
        }

    }

    public static function buscarEntregasNoche($id)
    {
        /*Muestra procesos entregados del dia actual desde 10:00pm a 11:59 pm*/
        if(Carbon::now()->toTimeString()>='22:00:00' && Carbon::now()->toTimeString()<='23:59:59') {

            $entregasNoche = Proceso::find($id)
                ->select('procesos.id', 'entregas.*', 'entregas.estado as Estado', 'entregas.id as EntregaID',
                    'entregas.hora_final as HoraFin', 'asignacion.id as FK_Asignacion')
                ->join('asignacion', 'asignacion.FK_Proceso', '=', 'procesos.id')
                ->join('entregas', 'entregas.FK_Asignacion', '=', 'asignacion.id')
                ->where('asignacion.FK_Proceso', '=', $id)
                ->where('entregas.fecha', '=',Carbon::now()->toDateString())
                ->get();

            return $entregasNoche;
        }

        /*Muestra procesos entregados del dia actual y anterior desde media noche a 11:59 pm*/
        if(Carbon::now()->toTimeString()>='00:00:00' && Carbon::now()->toTimeString()<='21:59:59') {

            $entregasNocheAnterior = Proceso::find($id)
                ->select('procesos.id', 'entregas.*', 'entregas.estado as Estado', 'entregas.id as EntregaID',
                    'entregas.hora_final as HoraFin', 'asignacion.id as FK_Asignacion')
                ->join('asignacion', 'asignacion.FK_Proceso', '=', 'procesos.id')
                ->join('turnos', 'turnos.id', '=', 'procesos.FK_Turno')
                ->join('entregas', 'entregas.FK_Asignacion', '=', 'asignacion.id')
                ->where('asignacion.FK_Proceso', '=', $id)
                ->where('turnos.nombre', '=', 'Noche')
                ->where(function ($query){
                    $query->where('entregas.fecha', '=', Carbon::now()->toDateString())
                        ->orWhere('entregas.fecha', '=', Carbon::yesterday()->toDateString());
                })
                ->get();

            return $entregasNocheAnterior;
        }

    }

    public static function buscarEntregasMensuales($id)
    {
        $entregasMensuales = Proceso::find($id)
            ->select('procesos.id', 'entregas.*', 'entregas.estado as Estado', 'entregas.id as EntregaID',
                'entregas.hora_final as HoraFin', 'asignacion.id as FK_Asignacion')
            ->join('asignacion', 'asignacion.FK_Proceso', '=', 'procesos.id')
            ->join('entregas', 'entregas.FK_Asignacion', '=', 'asignacion.id')
            ->where('asignacion.FK_Proceso', '=', $id)
            ->where('entregas.fecha', '=', Carbon::now()->toDateString())->get();

        return $entregasMensuales;
    }

    public static function buscarEntregasSemanales($id)
    {
        $entregasSemanales = Proceso::find($id)
            ->select('procesos.id', 'entregas.*', 'entregas.estado as Estado', 'entregas.id as EntregaID',
                'entregas.hora_final as HoraFin', 'asignacion.id as FK_Asignacion')
            ->join('asignacion', 'asignacion.FK_Proceso', '=', 'procesos.id')
            ->join('entregas', 'entregas.FK_Asignacion', '=', 'asignacion.id')
            ->where('asignacion.FK_Proceso', '=', $id)
            ->where('entregas.fecha', '=', Carbon::now()->toDateString())->get();

        return $entregasSemanales;
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
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        $user = \Auth::user()->user_red;


        if ($request->ajax()) {

            $v = \Validator::make($request->all(), [
                'estado' => 'required',
                'FK_Asignacion' => 'required',
            ]);

            if ($v->fails())
            {
                Session::flash('flash_message', $v->errors());
            }

            $eProceso = Proceso::find($request->proceso_id)
                ->select('procesos.id', 'entregas.*', 'entregas.estado', 'entregas.id as EntregaID',
                    'entregas.hora_final as HoraFin', 'asignacion.id as FK_Asignacion')
                ->join('asignacion', 'asignacion.FK_Proceso', '=', 'procesos.id')
                ->join('entregas', 'entregas.FK_Asignacion', '=', 'asignacion.id')
                ->where('asignacion.FK_Proceso', '=', $request->proceso_id)
                ->where('entregas.fecha','=',Carbon::now()->toDateString())
                ->get();

            if($eProceso=="[]"){
                $EntregaProceso = new Entregas();
                if($request->turno!="Noche"){
                    $EntregaProceso->fecha = Carbon::now()->toDateString();
                }else{
                    $EntregaProceso->fecha = Carbon::yesterday()->toDateString();
                }
                $EntregaProceso->registro = $user;
                $EntregaProceso->estado = $request->estado;
                $EntregaProceso->justificacion = $request->justificacion;
                if($request->horaF==""){
                    $EntregaProceso->hora_final = null;
                }else{
                    $EntregaProceso->hora_final = $request->horaF;
                }
                $EntregaProceso->FK_Asignacion = $request->asignacion;
                $EntregaProceso->save();
                Session::flash('flash_message', 'Task successfully added!');
            }
        }
        return redirect()->back();
    }

    public function editEntrega(Request $request)
    {

        $user = \Auth::user()->user_red;

        if ($request->ajax()) {

            $v = \Validator::make($request->all(), [

                'estado' => 'required',
                'hora_final' => 'required',
            ]);

            if ($v->fails())
            {
                Session::flash('flash_message', $v->errors());
            }

            $entrega = Entregas::find($request->idE);
            if($request->turnoE!="Noche"){
                $entrega->fecha = Carbon::now()->toDateString();
            }else{
                $entrega->fecha = Carbon::yesterday()->toDateString();
            }
            $entrega->registro = $user;
            $entrega->estado = $request->estadoE;
            $entrega->justificacion = $request->justificacionE;
            if($request->horaFin==""){
                $entrega->hora_final = null;
            }else{
                $entrega->hora_final = $request->horaFin;
            }

            $entrega->save();
        } else {

            Session::flash('flash_message', 'error :)');
        }

        return redirect()->back();
    }


    public function registrarEjecucion(Request $request)
    {
        $user = \Auth::user()->user_red;

        if($request->ajax()){

            if($request->turno=="Noche"){
                $bEProceso = Proceso::find($request->idProceso)
                    ->select('procesos.id', 'entregas.*', 'entregas.estado', 'entregas.id as EntregaID',
                        'entregas.hora_final as HoraFin', 'asignacion.id as FK_Asignacion')
                    ->join('asignacion', 'asignacion.FK_Proceso', '=', 'procesos.id')
                    ->join('entregas', 'entregas.FK_Asignacion', '=', 'asignacion.id')
                    ->where('asignacion.FK_Proceso', '=', $request->idProceso)
                    ->where('entregas.fecha','=',$request->fecha)
                    ->get();

                if($bEProceso=="[]"){
                    $EntregaProceso = new Entregas;
                    $EntregaProceso->fecha =$request->fecha;
                    $EntregaProceso->registro = $user;
                    $EntregaProceso->estado = $request->estado;
                    $EntregaProceso->FK_Asignacion = $request->asignacion;
                    $EntregaProceso->save();
                }

            }else{
                $bEProceso = Proceso::find($request->idProceso)
                    ->select('procesos.id', 'entregas.*', 'entregas.estado', 'entregas.id as EntregaID',
                        'entregas.hora_final as HoraFin', 'asignacion.id as FK_Asignacion')
                    ->join('asignacion', 'asignacion.FK_Proceso', '=', 'procesos.id')
                    ->join('entregas', 'entregas.FK_Asignacion', '=', 'asignacion.id')
                    ->where('asignacion.FK_Proceso', '=', $request->idProceso)
                    ->where('entregas.fecha','=',Carbon::now()->toDateString())
                    ->get();

                if($bEProceso=="[]"){
                    $EntregaProceso = new Entregas;
                    $EntregaProceso->fecha =$request->fecha;
                    $EntregaProceso->registro = $user;
                    $EntregaProceso->estado = $request->estado;
                    $EntregaProceso->FK_Asignacion = $request->asignacion;
                    $EntregaProceso->save();
                }
            }
        }
        return redirect()->back();
    }



    public static function traerNombre(){
        $dt= Carbon::now();
        Carbon::setLocale('es');
        return $dt->formatLocalized('%A %d %B %Y');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
