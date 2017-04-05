<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proceso as Proceso;
use App\Models\SLA as SLA;
use App\Models\Proceso_SLA as PSLA;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProcesoSLAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
        //
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
        //
    }



    public static function calcularSLA($id)
    {
        $slaProceso = Proceso::find($id)
            ->select(DB::raw("TIMEDIFF(entregas.hora_final,addtime(procesos.Horario,procesos.t_ejecucion)) as 'diferencia'"),
                DB::raw("addtime(procesos.Horario,procesos.t_ejecucion) as 'promedio'"),
                DB::raw("procesos.id as 'idProceso'"),
                DB::raw("entregas.estado as 'estadoEntregas'"))
            ->join('asignacion', 'asignacion.FK_Proceso', '=', 'procesos.id')
            ->join('entregas', 'entregas.FK_Asignacion', '=', 'asignacion.id')
            ->where('asignacion.FK_Proceso', '=', $id)
            ->where('entregas.fecha', '=', Carbon::now()->toDateString())
            ->where('entregas.estado','!=','En ejecucion')
            ->get();

        foreach ($slaProceso as $sla) {

            if($sla->diferencia==null){
                $t_diferencia="vacio";
            }else{
                $t_diferencia=($sla->diferencia);
            }

            $estado=$sla->estadoEntregas;

            if($estado!="Fallido"){

                if($t_diferencia < "00:00:00" || $t_diferencia >= "00:00:00" && $t_diferencia < "01:00:00"){
                    $bSLA = SLA::orderBy('created_at', 'DESC')
                        ->select('sla.*')
                        ->where('sla.porcentaje', '=',"100")
                        ->get();

                    $pSLA = PSLA::orderBy('created_at', 'DESC')
                        ->select('proceso_sla.*', 'procesos.id')
                        ->join('procesos','proceso_sla.FK_Proceso', '=', 'procesos.id')
                        ->where('proceso_sla.FK_Proceso', '=', $sla->idProceso)
                        ->where('proceso_sla.fecha', '=', Carbon::now()->toDateString())
                        ->get();

                    if ($pSLA == '[]') {
                        $ProcesoSLA = new PSLA();
                        $ProcesoSLA->fecha = Carbon::now();
                        $ProcesoSLA->FK_Proceso = $sla->idProceso;
                        foreach ($bSLA as $SLA){
                            $ProcesoSLA->FK_SLA = $SLA->id;
                        }
                        $ProcesoSLA->save();
                    }

                }

                if($t_diferencia >= "01:00:00" && $t_diferencia < "02:00:00"){

                    $bSLA = SLA::orderBy('created_at', 'DESC')
                        ->select('sla.*')
                        ->where('sla.porcentaje', '=',"75")
                        ->get();

                    $pSLA = PSLA::orderBy('created_at', 'DESC')
                        ->select('proceso_sla.*', 'procesos.id')
                        ->join('procesos','proceso_sla.FK_Proceso', '=', 'procesos.id')
                        ->where('proceso_sla.fecha', '=', Carbon::now()->toDateString())
                        ->where('proceso_sla.FK_Proceso', '=', $sla->idProceso)
                        ->get();

                    if ($pSLA == '[]') {
                        $ProcesoSLA = new PSLA();
                        $ProcesoSLA->fecha = Carbon::now();
                        $ProcesoSLA->FK_Proceso = $sla->idProceso;
                        foreach ($bSLA as $SLA){
                            $ProcesoSLA->FK_SLA = $SLA->id;
                        }
                        $ProcesoSLA->save();
                    }
                }

                if($t_diferencia >= "02:00:00" && $t_diferencia < "03:00:00"){

                    $bSLA = SLA::orderBy('created_at', 'DESC')
                        ->select('sla.*')
                        ->where('sla.porcentaje', '=',"50")
                        ->get();

                    $pSLA = PSLA::orderBy('created_at', 'DESC')
                        ->select('proceso_sla.*', 'procesos.id')
                        ->join('procesos','proceso_sla.FK_Proceso', '=', 'procesos.id')
                        ->where('proceso_sla.fecha', '=', Carbon::now()->toDateString())
                        ->where('proceso_sla.FK_Proceso', '=', $sla->idProceso)
                        ->get();

                    if ($pSLA == '[]') {
                        $ProcesoSLA = new PSLA();
                        $ProcesoSLA->fecha = Carbon::now();
                        $ProcesoSLA->FK_Proceso = $sla->idProceso;
                        foreach ($bSLA as $SLA){
                            $ProcesoSLA->FK_SLA = $SLA->id;
                        }
                        $ProcesoSLA->save();
                    }
                }

                if($t_diferencia >= "03:00:00" && $t_diferencia < "04:00:00"){

                    $bSLA = SLA::orderBy('created_at', 'DESC')
                        ->select('sla.*')
                        ->where('sla.porcentaje', '=',"25")
                        ->get();

                    $pSLA = PSLA::orderBy('created_at', 'DESC')
                        ->select('proceso_sla.*', 'procesos.id')
                        ->join('procesos','proceso_sla.FK_Proceso', '=', 'procesos.id')
                        ->where('proceso_sla.fecha', '=', Carbon::now()->toDateString())
                        ->where('proceso_sla.FK_Proceso', '=', $sla->idProceso)
                        ->get();

                    if ($pSLA == '[]') {
                        $ProcesoSLA = new PSLA();
                        $ProcesoSLA->fecha = Carbon::now();
                        $ProcesoSLA->FK_Proceso = $sla->idProceso;
                        foreach ($bSLA as $SLA){
                            $ProcesoSLA->FK_SLA = $SLA->id;
                        }
                        $ProcesoSLA->save();
                    }
                }

                if($t_diferencia >= "04:00:00" || $t_diferencia =="vacio"){

                    $bSLA = SLA::orderBy('created_at', 'DESC')
                        ->select('sla.*')
                        ->where('sla.porcentaje', '=',"0")
                        ->get();

                    $pSLA = PSLA::orderBy('created_at', 'DESC')
                        ->select('proceso_sla.*', 'procesos.id')
                        ->join('procesos','proceso_sla.FK_Proceso', '=', 'procesos.id')
                        ->where('proceso_sla.fecha', '=', Carbon::now()->toDateString())
                        ->where('proceso_sla.FK_Proceso', '=', $sla->idProceso)
                        ->get();

                    if ($pSLA == '[]') {
                        $ProcesoSLA = new PSLA();
                        $ProcesoSLA->fecha = Carbon::now();
                        $ProcesoSLA->FK_Proceso = $sla->idProceso;
                        foreach ($bSLA as $SLA){
                            $ProcesoSLA->FK_SLA = $SLA->id;
                        }
                        $ProcesoSLA->save();
                    }
                }

            }elseif($estado=="Fallido"){

                $bSLA = SLA::orderBy('created_at', 'DESC')
                    ->select('sla.*')
                    ->where('sla.porcentaje', '=',"0")
                    ->get();

                $pSLA = PSLA::orderBy('created_at', 'DESC')
                    ->select('proceso_sla.*', 'procesos.id')
                    ->join('procesos','proceso_sla.FK_Proceso', '=', 'procesos.id')
                    ->where('proceso_sla.fecha', '=', Carbon::now()->toDateString())
                    ->where('proceso_sla.FK_Proceso', '=', $sla->idProceso)
                    ->get();

                if ($pSLA == '[]') {
                    $ProcesoSLA = new PSLA();
                    $ProcesoSLA->fecha = Carbon::now();
                    $ProcesoSLA->FK_Proceso = $sla->idProceso;
                    foreach ($bSLA as $SLA){
                        $ProcesoSLA->FK_SLA = $SLA->id;
                    }
                    $ProcesoSLA->save();
                }
            }

        }
    }


    public static function calcularSLANoche($id)
    {
        $slaProceso = Proceso::find($id)
            ->select(DB::raw("TIMEDIFF(entregas.hora_final,addtime(procesos.Horario,procesos.t_ejecucion)) as 'diferencia'"),
                DB::raw("addtime(procesos.Horario,procesos.t_ejecucion) as 'promedio'"),
                DB::raw("procesos.id as 'idProceso'"),
                DB::raw("entregas.fecha as 'entregaFecha'"),
                DB::raw("entregas.created_at as 'creacionEntrega'"),
                DB::raw("entregas.updated_at as 'actualizacionEntrega'"),
                DB::raw("entregas.estado as 'estadoEntregas'"))
            ->join('asignacion', 'asignacion.FK_Proceso', '=', 'procesos.id')
            ->join('entregas', 'entregas.FK_Asignacion', '=', 'asignacion.id')
            ->where('asignacion.FK_Proceso', '=', $id)
            ->where('entregas.fecha', '=', Carbon::yesterday()->toDateString())
            ->where('entregas.estado','!=','En ejecucion')
            ->get();

        foreach ($slaProceso as $sla){

            if($sla->diferencia==null){
                $diferencia="vacio";
            }else{
                $diferencia=($sla->diferencia);
            }

            $fechaEntrega=$sla->entregaFecha;
            $estadoEntrega=$sla->estadoEntregas;

            if($diferencia=="vacio"){

                self::registrarSLANoche($diferencia,$sla->idProceso,$estadoEntrega);

            }else{
                if($sla->creacionEntrega != $sla->actualizacionEntrega){

                    /*Si la fecha de creacion de entrega es diferente a la fecha de actualización se toma la fecha
                    de actualización como valor principal*/

                    $fechaActualizacion=Carbon::parse($sla->actualizacionEntrega)->format('Y-m-d');

                    if($fechaActualizacion!=$fechaEntrega){

                        list($horas,$minutos,$segundos)=explode(":",$diferencia);/*Se separa la hora total en hora, minutos y segundos*/

                        $negativo=strstr($diferencia,'-');/*Se valida si la hora viene negativa*/

                        if($negativo==false){

                            return "Diferencia ".$diferencia;
                            self::registrarSLANoche($diferencia,$sla->idProceso,$estadoEntrega);

                        }else{
                            $horas+=24; /*Se suman 24 horas para que la hora no sea negativa y sea correcta*/
                            $hora_en_segundos=(($horas*3600))+($minutos*60)+$segundos; /*Hora en segundos*/

                            $h=($hora_en_segundos/3600%60); /*Segundos a hora */
                            $m=(($hora_en_segundos-($h*3600))/60%60); /*Segundos a minutos*/
                            $s= $hora_en_segundos-($h*3600)-($m*60); /*Segundos */

                            if($h<=9){ /*Si la hora, minuto, o segundo es de un solo digito agrega 0 al inicio*/
                                $h="0".$h;
                            }
                            if($m<=9){
                                $m="0".$m;
                            }
                            if($s<=9){
                                $s="0".$s;
                            }

                            $diferenciaCorrecta=$h.":".$m.":".$s;

                            self::registrarSLANoche($diferenciaCorrecta,$sla->idProceso,$estadoEntrega);

                            return "La diferencia es de: ".$diferencia." ----- Hora correcta: ". $diferenciaCorrecta;
                        }
                    }else{
                        self::registrarSLANoche($diferencia,$sla->idProceso,$estadoEntrega);
                        return "Diferencia".$diferencia;
                    }
                }else{

                    /*Si la fecha de creacion de entrega es igual a la fecha de actualización se toma la fecha
                    de creacion como valor principal*/

                    $fechaCreacion=Carbon::parse($sla->creacionEntrega)->format('Y-m-d');

                    if($fechaCreacion!=$fechaEntrega){

                        list($horas,$minutos,$segundos)=explode(":",$diferencia);

                        $negativo=strstr($diferencia,'-');

                        if($negativo==false){
                            self::registrarSLANoche($diferencia,$sla->idProceso,$estadoEntrega);
                            return "Diferencia: ".$diferencia;

                        }else{
                            /*Si encuentra negativa la hora y el dia de registro con actualizacion no coincide*/
                            $horas+=24;
                            $hora_en_segundos=(($horas*3600))+($minutos*60)+$segundos;

                            $h=($hora_en_segundos/3600%60);
                            $m=(($hora_en_segundos-($h*3600))/60%60);
                            $s= $hora_en_segundos-($h*3600)-($m*60);

                            if($h<=9){
                                $h="0".$h;
                            }elseif($m<=9){
                                $m="0".$m;
                            }elseif($s<=9){
                                $s="0".$s;
                            }

                            $diferenciaCorrecta=$h.":".$m.":".$s;
                            self::registrarSLANoche($diferenciaCorrecta,$sla->idProceso,$estadoEntrega);
                            return "Diferencia es de: ".$diferencia." ----- Hora correcta: ". $diferenciaCorrecta;
                        }
                    }else{
                        return "Diferencia u: ".$diferencia;
                        self::registrarSLANoche($diferencia,$sla->idProceso,$estadoEntrega);
                    }
                }
            }

        }
    }

    public static function registrarSLANoche($t_diferencia,$idProceso,$estadoE){

        if(Carbon::now()->toTimeString()>='22:00:00' && Carbon::now()->toTimeString()<='23:59:59') {

            if($estadoE!="Fallido"){
                if($t_diferencia < "00:00:00" || $t_diferencia >= "00:00:00" && $t_diferencia < "01:00:00"){
                    $bSLA = SLA::orderBy('created_at', 'DESC')
                        ->select('sla.*')
                        ->where('sla.porcentaje', '=',"100")
                        ->get();

                    $pSLA = PSLA::orderBy('created_at', 'DESC')
                        ->select('proceso_sla.*', 'procesos.id')
                        ->join('procesos','proceso_sla.FK_Proceso', '=', 'procesos.id')
                        ->where('proceso_sla.FK_Proceso', '=', $idProceso)
                        ->where('proceso_sla.fecha', '=', Carbon::now()->toDateString())
                        ->get();

                    if ($pSLA == '[]') {
                        $ProcesoSLA = new PSLA();
                        $ProcesoSLA->fecha = Carbon::now();
                        $ProcesoSLA->FK_Proceso = $idProceso;
                        foreach ($bSLA as $SLA){
                            $ProcesoSLA->FK_SLA = $SLA->id;
                        }
                        $ProcesoSLA->save();
                        return $bSLA;
                    }
                }

                if($t_diferencia >= "01:00:00" && $t_diferencia < "02:00:00"){

                    $bSLA = SLA::orderBy('created_at', 'DESC')
                        ->select('sla.*')
                        ->where('sla.porcentaje', '=',"75")
                        ->get();

                    $pSLA = PSLA::orderBy('created_at', 'DESC')
                        ->select('proceso_sla.*', 'procesos.id')
                        ->join('procesos','proceso_sla.FK_Proceso', '=', 'procesos.id')
                        ->where('proceso_sla.fecha', '=', Carbon::now()->toDateString())
                        ->where('proceso_sla.FK_Proceso', '=', $idProceso)
                        ->get();

                    if ($pSLA == '[]') {
                        $ProcesoSLA = new PSLA();
                        $ProcesoSLA->fecha = Carbon::now();
                        $ProcesoSLA->FK_Proceso = $idProceso;
                        foreach ($bSLA as $SLA){
                            $ProcesoSLA->FK_SLA = $SLA->id;
                        }
                        $ProcesoSLA->save();
                    }
                }

                if($t_diferencia >= "02:00:00" && $t_diferencia < "03:00:00"){

                    $bSLA = SLA::orderBy('created_at', 'DESC')
                        ->select('sla.*')
                        ->where('sla.porcentaje', '=',"50")
                        ->get();

                    $pSLA = PSLA::orderBy('created_at', 'DESC')
                        ->select('proceso_sla.*', 'procesos.id')
                        ->join('procesos','proceso_sla.FK_Proceso', '=', 'procesos.id')
                        ->where('proceso_sla.fecha', '=', Carbon::now()->toDateString())
                        ->where('proceso_sla.FK_Proceso', '=', $idProceso)
                        ->get();

                    if ($pSLA == '[]') {
                        $ProcesoSLA = new PSLA();
                        $ProcesoSLA->fecha = Carbon::now();
                        $ProcesoSLA->FK_Proceso = $idProceso;
                        foreach ($bSLA as $SLA){
                            $ProcesoSLA->FK_SLA = $SLA->id;
                        }
                        $ProcesoSLA->save();
                    }
                }

                if($t_diferencia >= "03:00:00" && $t_diferencia < "04:00:00"){

                    $bSLA = SLA::orderBy('created_at', 'DESC')
                        ->select('sla.*')
                        ->where('sla.porcentaje', '=',"25")
                        ->get();

                    $pSLA = PSLA::orderBy('created_at', 'DESC')
                        ->select('proceso_sla.*', 'procesos.id')
                        ->join('procesos','proceso_sla.FK_Proceso', '=', 'procesos.id')
                        ->where('proceso_sla.fecha', '=', Carbon::now()->toDateString())
                        ->where('proceso_sla.FK_Proceso', '=', $idProceso)
                        ->get();

                    if ($pSLA == '[]') {
                        $ProcesoSLA = new PSLA();
                        $ProcesoSLA->fecha = Carbon::now();
                        $ProcesoSLA->FK_Proceso = $idProceso;
                        foreach ($bSLA as $SLA){
                            $ProcesoSLA->FK_SLA = $SLA->id;
                        }
                        $ProcesoSLA->save();
                    }
                }

                if($t_diferencia >= "04:00:00" || $t_diferencia =="vacio") {

                    $bSLA = SLA::orderBy('created_at', 'DESC')
                        ->select('sla.*')
                        ->where('sla.porcentaje', '=', "0")
                        ->get();

                    $pSLA = PSLA::orderBy('created_at', 'DESC')
                        ->select('proceso_sla.*', 'procesos.id')
                        ->join('procesos', 'proceso_sla.FK_Proceso', '=', 'procesos.id')
                        ->where('proceso_sla.fecha', '=', Carbon::now()->toDateString())
                        ->where('proceso_sla.FK_Proceso', '=', $idProceso)
                        ->get();

                    if ($pSLA == '[]') {
                        $ProcesoSLA = new PSLA();
                        $ProcesoSLA->fecha = Carbon::now();
                        $ProcesoSLA->FK_Proceso = $idProceso;
                        foreach ($bSLA as $SLA) {
                            $ProcesoSLA->FK_SLA = $SLA->id;
                        }
                        $ProcesoSLA->save();
                    }
                }
            }elseif ($estadoE=="Fallido"){
                $bSLA = SLA::orderBy('created_at', 'DESC')
                    ->select('sla.*')
                    ->where('sla.porcentaje', '=', "0")
                    ->get();

                $pSLA = PSLA::orderBy('created_at', 'DESC')
                    ->select('proceso_sla.*', 'procesos.id')
                    ->join('procesos', 'proceso_sla.FK_Proceso', '=', 'procesos.id')
                    ->where('proceso_sla.fecha', '=', Carbon::now()->toDateString())
                    ->where('proceso_sla.FK_Proceso', '=', $idProceso)
                    ->get();

                if ($pSLA == '[]') {
                    $ProcesoSLA = new PSLA();
                    $ProcesoSLA->fecha = Carbon::now();
                    $ProcesoSLA->FK_Proceso = $idProceso;
                    foreach ($bSLA as $SLA) {
                        $ProcesoSLA->FK_SLA = $SLA->id;
                    }
                    $ProcesoSLA->save();
                }
            }


        }

        if(Carbon::now()->toTimeString()>='00:00:00' && Carbon::now()->toTimeString()<='21:59:59') {

            if ($estadoE!="Fallido"){
                if($t_diferencia < "00:00:00" || $t_diferencia >= "00:00:00" && $t_diferencia < "01:00:00"){
                    $bSLA = SLA::orderBy('created_at', 'DESC')
                        ->select('sla.*')
                        ->where('sla.porcentaje', '=',"100")
                        ->get();

                    $pSLA = PSLA::orderBy('created_at', 'DESC')
                        ->select('proceso_sla.*', 'procesos.id')
                        ->join('procesos','proceso_sla.FK_Proceso', '=', 'procesos.id')
                        ->where('proceso_sla.FK_Proceso', '=', $idProceso)
                        ->where('proceso_sla.fecha', '=', Carbon::yesterday()->toDateString())
                        ->get();

                    if ($pSLA == '[]') {
                        $ProcesoSLA = new PSLA();
                        $ProcesoSLA->fecha = Carbon::yesterday()->toDateString();
                        $ProcesoSLA->FK_Proceso = $idProceso;
                        foreach ($bSLA as $SLA){
                            $ProcesoSLA->FK_SLA = $SLA->id;
                        }
                        $ProcesoSLA->save();
                        return $bSLA;
                    }
                }

                if($t_diferencia >= "01:00:00" && $t_diferencia < "02:00:00"){

                    $bSLA = SLA::orderBy('created_at', 'DESC')
                        ->select('sla.*')
                        ->where('sla.porcentaje', '=',"75")
                        ->get();

                    $pSLA = PSLA::orderBy('created_at', 'DESC')
                        ->select('proceso_sla.*', 'procesos.id')
                        ->join('procesos','proceso_sla.FK_Proceso', '=', 'procesos.id')
                        ->where('proceso_sla.fecha', '=', Carbon::yesterday()->toDateString())
                        ->where('proceso_sla.FK_Proceso', '=', $idProceso)
                        ->get();

                    if ($pSLA == '[]') {
                        $ProcesoSLA = new PSLA();
                        $ProcesoSLA->fecha = Carbon::yesterday()->toDateString();
                        $ProcesoSLA->FK_Proceso = $idProceso;
                        foreach ($bSLA as $SLA){
                            $ProcesoSLA->FK_SLA = $SLA->id;
                        }
                        $ProcesoSLA->save();
                    }
                }

                if($t_diferencia >= "02:00:00" && $t_diferencia < "03:00:00"){

                    $bSLA = SLA::orderBy('created_at', 'DESC')
                        ->select('sla.*')
                        ->where('sla.porcentaje', '=',"50")
                        ->get();

                    $pSLA = PSLA::orderBy('created_at', 'DESC')
                        ->select('proceso_sla.*', 'procesos.id')
                        ->join('procesos','proceso_sla.FK_Proceso', '=', 'procesos.id')
                        ->where('proceso_sla.fecha', '=', Carbon::yesterday()->toDateString())
                        ->where('proceso_sla.FK_Proceso', '=', $idProceso)
                        ->get();

                    if ($pSLA == '[]') {
                        $ProcesoSLA = new PSLA();
                        $ProcesoSLA->fecha = Carbon::yesterday()->toDateString();
                        $ProcesoSLA->FK_Proceso = $idProceso;
                        foreach ($bSLA as $SLA){
                            $ProcesoSLA->FK_SLA = $SLA->id;
                        }
                        $ProcesoSLA->save();
                    }
                }

                if($t_diferencia >= "03:00:00" && $t_diferencia < "04:00:00"){
                    $bSLA = SLA::orderBy('created_at', 'DESC')
                        ->select('sla.*')
                        ->where('sla.porcentaje', '=',"25")
                        ->get();

                    $pSLA = PSLA::orderBy('created_at', 'DESC')
                        ->select('proceso_sla.*', 'procesos.id')
                        ->join('procesos','proceso_sla.FK_Proceso', '=', 'procesos.id')
                        ->where('proceso_sla.fecha', '=', Carbon::yesterday()->toDateString())
                        ->where('proceso_sla.FK_Proceso', '=', $idProceso)
                        ->get();

                    if ($pSLA == '[]') {
                        $ProcesoSLA = new PSLA();
                        $ProcesoSLA->fecha = Carbon::yesterday()->toDateString();
                        $ProcesoSLA->FK_Proceso = $idProceso;
                        foreach ($bSLA as $SLA){
                            $ProcesoSLA->FK_SLA = $SLA->id;
                        }
                        $ProcesoSLA->save();
                    }
                }

                if($t_diferencia >= "04:00:00" || $t_diferencia =="vacio") {

                    $bSLA = SLA::orderBy('created_at', 'DESC')
                        ->select('sla.*')
                        ->where('sla.porcentaje', '=', "0")
                        ->get();

                    $pSLA = PSLA::orderBy('created_at', 'DESC')
                        ->select('proceso_sla.*', 'procesos.id')
                        ->join('procesos', 'proceso_sla.FK_Proceso', '=', 'procesos.id')
                        ->where('proceso_sla.fecha', '=', Carbon::yesterday()->toDateString())
                        ->where('proceso_sla.FK_Proceso', '=', $idProceso)
                        ->get();

                    if ($pSLA == '[]') {
                        $ProcesoSLA = new PSLA();
                        $ProcesoSLA->fecha = Carbon::yesterday()->toDateString();
                        $ProcesoSLA->FK_Proceso = $idProceso;
                        foreach ($bSLA as $SLA) {
                            $ProcesoSLA->FK_SLA = $SLA->id;
                        }
                        $ProcesoSLA->save();

                        return $bSLA;
                    }
                }
            }elseif ($estadoE=="Fallido"){
                $bSLA = SLA::orderBy('created_at', 'DESC')
                    ->select('sla.*')
                    ->where('sla.porcentaje', '=', "0")
                    ->get();

                $pSLA = PSLA::orderBy('created_at', 'DESC')
                    ->select('proceso_sla.*', 'procesos.id')
                    ->join('procesos', 'proceso_sla.FK_Proceso', '=', 'procesos.id')
                    ->where('proceso_sla.fecha', '=', Carbon::yesterday()->toDateString())
                    ->where('proceso_sla.FK_Proceso', '=', $idProceso)
                    ->get();

                if ($pSLA == '[]') {
                    $ProcesoSLA = new PSLA();
                    $ProcesoSLA->fecha = Carbon::yesterday()->toDateString();
                    $ProcesoSLA->FK_Proceso = $idProceso;
                    foreach ($bSLA as $SLA) {
                        $ProcesoSLA->FK_SLA = $SLA->id;
                    }
                    $ProcesoSLA->save();
                }
            }

        }

    }

}
