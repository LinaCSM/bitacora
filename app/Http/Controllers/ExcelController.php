<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Proceso;
use App\Models\Cargue as Cargue;
use App\Models\Entregable as Entregable;
use App\Models\Falla as Falla;
use App\Models\Proceso_Falla as PFalla;
use App\Models\Usuario as Responsable;
use App\Models\Proceso_SLA as PSLA;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        Excel::create('ProcesosDiarios', function($excel) {

            $excel->sheet('ProcesosDiarios', function($sheet) {
               $procesos=Proceso::orderBy('horario','ASC')
                    ->select('procesos.nombre as Nombre', 'procesos.plataforma as Plataforma',
                        'procesos.job as Job', 'procesos.servidor as Servidor', 'procesos.catalogo as Catálogo',
                        'procesos.tarea_programada as Tarea programada', 'procesos.prerequisitos as Prerequisitos',
                        'turnos.nombre as Turno','procesos.horario as Horario', 'procesos.t_ejecucion as Tiempo Ejecucion',
                        'procesos.sysdate as Sysdate','procesos.semaforo as Semáforo','procesos.estado as Estado',
                        'frecuencias.nombre as Frecuencia','frecuencia_proceso.dia as Días',
                        'grupos.nombre as Grupo','paises.nombre as Pais', 'tipos.nombre as Responsable'
                        )
                    ->join('turnos','procesos.FK_Turno','=','turnos.id')
                    ->join('tipos','procesos.FK_Tipo','=','tipos.id')
                    ->join('frecuencia_proceso','frecuencia_proceso.FK_Proceso','=','procesos.id')
                    ->join('frecuencias','frecuencia_proceso.FK_Frecuencia','=','frecuencias.id')
                    ->join('grupos','procesos.FK_Grupo','=','grupos.id')
                    ->join('paises','grupos.FK_Pais','=','paises.id')
                    ->where('frecuencias.nombre', '=', 'diaria')
                    ->get();

               $sheet->fromArray($procesos);

                $cantidad=count($procesos);
                $cantidad=$cantidad+1;

                $sheet->cells('A1:R1', function($cells) {
                    $cells->setBackground('#DADADA');
                    $cells->setFontFamily('Calibri Light');
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');

                });

               $sheet->cells("A2:R".$cantidad, function($cells) {
                    $cells->setBackground('#ffffff');
                    $cells->setFontFamily('Calibri Light');
                    $cells->setAlignment('center');
                });

                $sheet->appendRow(array(
                    '', ''
                ));

                $sheet->appendRow(array(
                    'Fecha creación: '.Carbon::now()
                ));

                $sheet->setBorder('A1:R1', 'thin');
                $sheet->setBorder("A2:R".$cantidad, 'thin');
                $sheet->setAutoSize(true);
            });
        })->download('xls');
        return view('Procesos/listProceso');
    }

    public function indexSemanal()
    {
        Excel::create('ProcesosSemanales', function($excel) {

            $excel->sheet('ProcesosSemanales', function($sheet) {
                $procesos=Proceso::orderBy('horario','ASC')
                    ->select('procesos.nombre as Nombre', 'procesos.plataforma as Plataforma',
                        'procesos.job as Job', 'procesos.servidor as Servidor', 'procesos.catalogo as Catálogo',
                        'procesos.tarea_programada as Tarea programada', 'procesos.prerequisitos as Prerequisitos',
                        'turnos.nombre as Turno','procesos.horario as Horario', 'procesos.t_ejecucion as Tiempo Ejecucion',
                        'procesos.sysdate as Sysdate','procesos.semaforo as Semáforo','procesos.estado as Estado',
                        'frecuencias.nombre as Frecuencia','frecuencia_proceso.dia as Días',
                        'grupos.nombre as Grupo','paises.nombre as Pais', 'tipos.nombre as Responsable'
                    )
                    ->join('turnos','procesos.FK_Turno','=','turnos.id')
                    ->join('tipos','procesos.FK_Tipo','=','tipos.id')
                    ->join('frecuencia_proceso','frecuencia_proceso.FK_Proceso','=','procesos.id')
                    ->join('frecuencias','frecuencia_proceso.FK_Frecuencia','=','frecuencias.id')
                    ->join('grupos','procesos.FK_Grupo','=','grupos.id')
                    ->join('paises','grupos.FK_Pais','=','paises.id')
                    ->where('frecuencias.nombre', '=', 'semanal')
                ->get();


                $sheet->fromArray($procesos);

                $cantidad=count($procesos);
                $cantidad=$cantidad+1;

                $sheet->cells('A1:R1', function($cells) {
                    $cells->setBackground('#DADADA');
                    $cells->setFontFamily('Calibri Light');
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');

                });

                $sheet->cells("A2:R".$cantidad, function($cells) {
                    $cells->setBackground('#ffffff');
                    $cells->setFontFamily('Calibri Light');
                    $cells->setAlignment('center');
                });

                $sheet->appendRow(array(
                    '', ''
                ));

                $sheet->appendRow(array(
                    'Fecha creación: '.Carbon::now()
                ));

                $sheet->setBorder('A1:R1', 'thin');
                $sheet->setBorder("A2:R".$cantidad, 'thin');
                $sheet->setAutoSize(true);
            });
        })->download('xls');
        return view('Procesos/listProcesoSemanal');
    }


    public function indexMensual()
    {
        Excel::create('ProcesosMensuales', function($excel) {

            $excel->sheet('ProcesosMensuales', function($sheet) {
                $procesos=Proceso::orderBy('horario','ASC')
                    ->select('procesos.nombre as Nombre', 'procesos.plataforma as Plataforma',
                        'procesos.job as Job', 'procesos.servidor as Servidor', 'procesos.catalogo as Catálogo',
                        'procesos.tarea_programada as Tarea programada', 'procesos.prerequisitos as Prerequisitos',
                        'turnos.nombre as Turno','procesos.horario as Horario', 'procesos.t_ejecucion as Tiempo Ejecucion',
                        'procesos.sysdate as Sysdate','procesos.semaforo as Semáforo','procesos.estado as Estado',
                        'frecuencias.nombre as Frecuencia','frecuencia_proceso.dia as Días',
                        'grupos.nombre as Grupo','paises.nombre as Pais', 'tipos.nombre as Responsable'
                    )
                    ->join('turnos','procesos.FK_Turno','=','turnos.id')
                    ->join('tipos','procesos.FK_Tipo','=','tipos.id')
                    ->join('frecuencia_proceso','frecuencia_proceso.FK_Proceso','=','procesos.id')
                    ->join('frecuencias','frecuencia_proceso.FK_Frecuencia','=','frecuencias.id')
                    ->join('grupos','procesos.FK_Grupo','=','grupos.id')
                    ->join('paises','grupos.FK_Pais','=','paises.id')
                    ->where('frecuencias.nombre', '=', 'mensual')
                    ->get();


                $sheet->fromArray($procesos);

                $cantidad=count($procesos);
                $cantidad=$cantidad+1;

                $sheet->cells('A1:R1', function($cells) {
                    $cells->setBackground('#DADADA');
                    $cells->setFontFamily('Calibri Light');
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');

                });

                $sheet->cells("A2:R".$cantidad, function($cells) {
                    $cells->setBackground('#ffffff');
                    $cells->setFontFamily('Calibri Light');
                    $cells->setAlignment('center');
                });

                $sheet->appendRow(array(
                    '', ''
                ));

                $sheet->appendRow(array(
                    'Fecha creación: '.Carbon::now()
                ));

                $sheet->setBorder('A1:R1', 'thin');
                $sheet->setBorder("A2:R".$cantidad, 'thin');
                $sheet->setAutoSize(true);
            });
        })->download('xls');
        return view('Procesos/listProcesoMensual');
    }

    public function indexDemanda()
    {
        Excel::create('ProcesosPorDemanda', function($excel) {

            $excel->sheet('ProcesosPorDemanda', function($sheet) {
                $procesos=Proceso::orderBy('horario','ASC')
                    ->select('procesos.nombre as Nombre', 'procesos.plataforma as Plataforma',
                        'procesos.job as Job', 'procesos.servidor as Servidor', 'procesos.catalogo as Catálogo',
                        'procesos.tarea_programada as Tarea programada', 'procesos.prerequisitos as Prerequisitos',
                        'turnos.nombre as Turno','procesos.horario as Horario', 'procesos.t_ejecucion as Tiempo Ejecucion',
                        'procesos.sysdate as Sysdate','procesos.semaforo as Semáforo','procesos.estado as Estado',
                        'frecuencias.nombre as Frecuencia','frecuencia_proceso.dia as Días',
                        'grupos.nombre as Grupo','paises.nombre as Pais', 'tipos.nombre as Responsable'
                    )
                    ->join('turnos','procesos.FK_Turno','=','turnos.id')
                    ->join('tipos','procesos.FK_Tipo','=','tipos.id')
                    ->join('frecuencia_proceso','frecuencia_proceso.FK_Proceso','=','procesos.id')
                    ->join('frecuencias','frecuencia_proceso.FK_Frecuencia','=','frecuencias.id')
                    ->join('grupos','procesos.FK_Grupo','=','grupos.id')
                    ->join('paises','grupos.FK_Pais','=','paises.id')
                    ->where('frecuencias.nombre', '=', 'demanda')
                    ->get();


                $sheet->fromArray($procesos);

                $cantidad=count($procesos);
                $cantidad=$cantidad+1;

                $sheet->cells('A1:R1', function($cells) {
                    $cells->setBackground('#DADADA');
                    $cells->setFontFamily('Calibri Light');
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');

                });

                $sheet->cells("A2:R".$cantidad, function($cells) {
                    $cells->setBackground('#ffffff');
                    $cells->setFontFamily('Calibri Light');
                    $cells->setAlignment('center');
                });

                $sheet->appendRow(array(
                    '', ''
                ));

                $sheet->appendRow(array(
                    'Fecha creación: '.Carbon::now()
                ));

                $sheet->setBorder('A1:R1', 'thin');
                $sheet->setBorder("A2:R".$cantidad, 'thin');
                $sheet->setAutoSize(true);
            });
        })->download('xls');
        return view('Procesos/listProcesoDemanda');
    }


    public function indexCargues()
    {
        Excel::create('Cargues', function($excel) {

            $excel->sheet('Cargues', function($sheet) {
                $cargues=Cargue::orderBy('hora_ejecucion','ASC')
                    ->select('cargues.nombre as Nombre','paises.nombre as País','cargues.tipo_archivo as Tipo_Archivo',
                        'cargues.ruta as Ruta','cargues.periodicidad as Periodicidad', 'cargues.plataforma as Plataforma',
                        'cargues.bd as Base_de_Datos', 'cargues.job as Job', 'cargues.tarea as Tarea_Programada',
                        'grupos.nombre as Grupo', 'cargues.servidor as Servidor', 'cargues.catalogo as Catálogo',
                        'tipos.nombre as Responsable')
                    ->join('cargue_grupo','cargue_grupo.FK_Cargue','=','cargues.id')
                    ->join('grupos','cargue_grupo.FK_Grupo','=','grupos.id')
                    ->join('paises','grupos.FK_Pais','=','paises.id')
                    ->join('tipos','cargues.FK_Tipo','=','tipos.id')
                    ->get();

                $sheet->fromArray($cargues);

                $cantidad=count($cargues);
                $cantidad=$cantidad+1;

                $sheet->cells('A1:M1', function($cells) {
                    $cells->setBackground('#DADADA');
                    $cells->setFontFamily('Calibri Light');
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');

                });

                $sheet->cells("A2:M".$cantidad, function($cells) {
                    $cells->setBackground('#ffffff');
                    $cells->setFontFamily('Calibri Light');
                    $cells->setAlignment('center');
                });

                $sheet->appendRow(array(
                    '', ''
                ));

                $sheet->appendRow(array(
                    'Fecha creación: '.Carbon::now()
                ));

                $sheet->setBorder('A1:M1', 'thin');
                $sheet->setBorder("A2:M".$cantidad, 'thin');
                $sheet->setAutoSize(true);
            });
        })->download('xls');
        return view('Cargues/listCargue');
    }

    public function indexCarguesColombia()
    {
        Excel::create('CarguesColombia', function($excel) {

            $excel->sheet('CarguesColombia', function($sheet) {
                $cargues=Cargue::orderBy('hora_ejecucion','ASC')
                    ->select('cargues.nombre as Nombre','paises.nombre as País','cargues.tipo_archivo as Tipo_Archivo',
                        'cargues.ruta as Ruta','cargues.periodicidad as Periodicidad', 'cargues.plataforma as Plataforma',
                        'cargues.bd as Base_de_Datos', 'cargues.job as Job', 'cargues.tarea as Tarea_Programada',
                        'grupos.nombre as Grupo', 'cargues.servidor as Servidor', 'cargues.catalogo as Catálogo',
                        'tipos.nombre as Responsable','cargues.estado as Estado')
                    ->join('cargue_grupo','cargue_grupo.FK_Cargue','=','cargues.id')
                    ->join('grupos','cargue_grupo.FK_Grupo','=','grupos.id')
                    ->join('paises','grupos.FK_Pais','=','paises.id')
                    ->join('tipos','cargues.FK_Tipo','=','tipos.id')
                    ->where('paises.nombre', '=', 'Colombia')
                    ->get();

                $sheet->fromArray($cargues);

                $cantidad=count($cargues);
                $cantidad=$cantidad+1;

                $sheet->cells('A1:N1', function($cells) {
                    $cells->setBackground('#DADADA');
                    $cells->setFontFamily('Calibri Light');
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');

                });

                $sheet->cells("A2:N".$cantidad, function($cells) {
                    $cells->setBackground('#ffffff');
                    $cells->setFontFamily('Calibri Light');
                    $cells->setAlignment('center');
                });

                $sheet->appendRow(array(
                    '', ''
                ));

                $sheet->appendRow(array(
                    'Fecha creación: '.Carbon::now()
                ));

                $sheet->setBorder('A1:N1', 'thin');
                $sheet->setBorder("A2:N".$cantidad, 'thin');
                $sheet->setAutoSize(true);
            });
        })->download('xls');
        return view('Cargues/listCargueA1');
    }

    public function indexCarguesPanama()
    {
        Excel::create('CarguesPanamá', function($excel) {

            $excel->sheet('CarguesPanamá', function($sheet) {
                $cargues=Cargue::orderBy('hora_ejecucion','ASC')
                    ->select('cargues.nombre as Nombre','paises.nombre as País','cargues.tipo_archivo as Tipo_Archivo',
                        'cargues.ruta as Ruta','cargues.periodicidad as Periodicidad', 'cargues.plataforma as Plataforma',
                        'cargues.bd as Base_de_Datos', 'cargues.job as Job', 'cargues.tarea as Tarea_Programada',
                        'grupos.nombre as Grupo', 'cargues.servidor as Servidor', 'cargues.catalogo as Catálogo',
                        'tipos.nombre as Responsable','cargues.estado as Estado')
                    ->join('cargue_grupo','cargue_grupo.FK_Cargue','=','cargues.id')
                    ->join('grupos','cargue_grupo.FK_Grupo','=','grupos.id')
                    ->join('paises','grupos.FK_Pais','=','paises.id')
                    ->join('tipos','cargues.FK_Tipo','=','tipos.id')
                    ->where('paises.nombre', '=', 'Panama')
                    ->get();

                $sheet->fromArray($cargues);

                $cantidad=count($cargues);
                $cantidad=$cantidad+1;

                $sheet->cells('A1:N1', function($cells) {
                    $cells->setBackground('#DADADA');
                    $cells->setFontFamily('Calibri Light');
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');

                });

                $sheet->cells("A2:N".$cantidad, function($cells) {
                    $cells->setBackground('#ffffff');
                    $cells->setFontFamily('Calibri Light');
                    $cells->setAlignment('center');
                });

                $sheet->appendRow(array(
                    '', ''
                ));

                $sheet->appendRow(array(
                    'Fecha creación: '.Carbon::now()
                ));

                $sheet->setBorder('A1:N1', 'thin');
                $sheet->setBorder("A2:N".$cantidad, 'thin');
                $sheet->setAutoSize(true);
            });
        })->download('xls');
        return view('Cargues/listCargueA1');
    }

    public function indexEntregable()
    {
        Excel::create('Entregables', function($excel) {

            $excel->sheet('Entregables', function($sheet) {

                $entregables= Entregable::select('procesos.nombre as Proceso',
                    'entregables.tipo as Tipo','entregables.ruta as Ruta',DB::raw('addtime(procesos.Horario,procesos.t_ejecucion) as Hora_Aproximada'),
                    'frecuencias.nombre as Frecuencia','procesos.sysdate as Sysdate','procesos.plataforma as Plataforma','grupos.nombre as Grupo',
                    'paises.nombre as Pais','tipos.nombre as Responsable','entregables.estado as Estado')
                    ->join('asignacion','asignacion.FK_Entregable','=','entregables.id')
                    ->join('procesos','asignacion.FK_Proceso','=','procesos.id')
                    ->join('frecuencia_proceso','frecuencia_proceso.FK_Proceso','=','procesos.id')
                    ->join('frecuencias','frecuencia_proceso.FK_Frecuencia','=','frecuencias.id')
                    ->join('tipos','procesos.FK_Tipo','=','tipos.id')
                    ->join('grupos','procesos.FK_Grupo','=','grupos.id')
                    ->join('paises','grupos.FK_Pais','=','paises.id')
                    ->distinct('asignacion.id')
                    ->get();


                $sheet->fromArray($entregables);

                $cantidad=count($entregables);
                $cantidad=$cantidad+1;

                $sheet->cells('A1:K1', function($cells) {
                    $cells->setBackground('#DADADA');
                    $cells->setFontFamily('Calibri Light');
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');

                });

                $sheet->cells("A2:K".$cantidad, function($cells) {
                    $cells->setBackground('#ffffff');
                    $cells->setFontFamily('Calibri Light');
                    $cells->setAlignment('center');
                });

                $sheet->appendRow(array(
                    '', ''
                ));

                $sheet->appendRow(array(
                    'Fecha creación: '.Carbon::now()
                ));

                $sheet->setBorder('A1:K1', 'thin');
                $sheet->setBorder("A2:K".$cantidad, 'thin');
                $sheet->setAutoSize(true);
            });
        })->download('xls');
        return view('Entregables/listEntregables');
    }

    public function indexFallaDiaria()
    {
        $fechaActual=Carbon::now()->toDateString();
        Excel::create('Fallas '.$fechaActual, function($excel) {

            $excel->sheet('Fallas', function($sheet) {

                if (Carbon::now()->toTimeString() >= '22:00:00' && Carbon::now()->toTimeString() <= '23:59:59') {
                    $fallas = Falla::orderBy('fecha', 'ASC')
                        ->select('fallas.fecha as Fecha','procesos.job as Proceso','fallas.n_caso as N°_Caso',
                            'fallas.tipo as Tipo','fallas.descripcion as Descripción','fallas.estado as Estado',
                            'fallas.solucion as Solución','fallas.r_proceso as ¿Proceso_Relanzado?','procesos.plataforma as Plataforma',
                            'frecuencias.nombre as Frecuencia','turnos.nombre as Turno','tipos.nombre as Responsable')
                        ->join('procesos', 'fallas.FK_Proceso', '=', 'procesos.id')
                        ->join('tipos', 'procesos.FK_Tipo', '=', 'tipos.id')
                        ->join('turnos', 'procesos.FK_Turno', '=', 'turnos.id')
                        ->join('frecuencia_proceso', 'frecuencia_proceso.FK_Proceso', '=', 'procesos.id')
                        ->join('frecuencias', 'frecuencia_proceso.FK_Frecuencia', '=', 'frecuencias.id')
                        ->join('asignacion', 'asignacion.FK_Proceso', '=', 'procesos.id')
                        ->join('entregas', 'entregas.FK_Asignacion', '=', 'asignacion.id')
                        ->where('fallas.fecha', '=', Carbon::now()->toDateString())
                        ->where('entregas.fecha', '=', Carbon::now()->toDateString())
                        ->get();
                }

                if (Carbon::now()->toTimeString() >= '00:00:00' && Carbon::now()->toTimeString() <= '21:59:59') {

                    $fallasDiarias = Falla::orderBy('fecha', 'ASC')
                        ->select('fallas.fecha as Fecha','procesos.job as Proceso','fallas.n_caso as N°_Caso',
                            'fallas.tipo as Tipo','fallas.descripcion as Descripción','fallas.estado as Estado',
                            'fallas.solucion as Solución','fallas.r_proceso as ¿Proceso_Relanzado?','procesos.plataforma as Plataforma',
                            'frecuencias.nombre as Frecuencia','turnos.nombre as Turno','tipos.nombre as Responsable')
                        ->join('procesos', 'fallas.FK_Proceso', '=', 'procesos.id')
                        ->join('tipos', 'procesos.FK_Tipo', '=', 'tipos.id')
                        ->join('turnos', 'procesos.FK_Turno', '=', 'turnos.id')
                        ->join('frecuencia_proceso', 'frecuencia_proceso.FK_Proceso', '=', 'procesos.id')
                        ->join('frecuencias', 'frecuencia_proceso.FK_Frecuencia', '=', 'frecuencias.id')
                        ->join('asignacion', 'asignacion.FK_Proceso', '=', 'procesos.id')
                        ->join('entregas', 'entregas.FK_Asignacion', '=', 'asignacion.id')
                        ->where('turnos.nombre', '!=', 'Noche')
                        ->where('fallas.fecha', '=', Carbon::now()->toDateString())
                        ->where('entregas.fecha', '=', Carbon::now()->toDateString());

                    $fallas = Falla::orderBy('fecha', 'ASC')
                        ->select('fallas.fecha as Fecha','procesos.job as Proceso','fallas.n_caso as N°_Caso',
                            'fallas.tipo as Tipo','fallas.descripcion as Descripción','fallas.estado as Estado',
                            'fallas.solucion as Solución','fallas.r_proceso as ¿Proceso_Relanzado?','procesos.plataforma as Plataforma',
                            'frecuencias.nombre as Frecuencia','turnos.nombre as Turno','tipos.nombre as Responsable')
                        ->join('procesos', 'fallas.FK_Proceso', '=', 'procesos.id')
                        ->join('tipos', 'procesos.FK_Tipo', '=', 'tipos.id')
                        ->join('turnos', 'procesos.FK_Turno', '=', 'turnos.id')
                        ->join('frecuencia_proceso', 'frecuencia_proceso.FK_Proceso', '=', 'procesos.id')
                        ->join('frecuencias', 'frecuencia_proceso.FK_Frecuencia', '=', 'frecuencias.id')
                        ->join('asignacion', 'asignacion.FK_Proceso', '=', 'procesos.id')
                        ->join('entregas', 'entregas.FK_Asignacion', '=', 'asignacion.id')
                        ->where('turnos.nombre', '=', 'Noche')
                        ->where('fallas.fecha', '=', Carbon::yesterday()->toDateString())
                        ->where('entregas.fecha', '=', Carbon::yesterday()->toDateString())
                        ->union($fallasDiarias)
                        ->get();
                }

                $sheet->fromArray($fallas);

                $cantidad=count($fallas);
                $cantidad=$cantidad+1;

                $sheet->cells('A1:L1', function($cells) {
                    $cells->setBackground('#DADADA');
                    $cells->setFontFamily('Calibri Light');
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');

                });

                $sheet->cells("A2:L".$cantidad, function($cells) {
                    $cells->setBackground('#ffffff');
                    $cells->setFontFamily('Calibri Light');
                    $cells->setAlignment('center');
                });

                $sheet->appendRow(array(
                    '', ''
                ));

                $sheet->appendRow(array(
                    'Fecha creación: '.Carbon::now()
                ));

                $sheet->setBorder('A1:L1', 'thin');
                $sheet->setBorder("A2:L".$cantidad, 'thin');
                $sheet->setAutoSize(true);
            });
        })->download('xls');
        return view('Fallas/FallasDiarias');
    }

    public function indexFallaMensual()
    {
        setlocale(LC_TIME, config('app.locale'));
        $mes=ucfirst(Carbon::now()->formatLocalized('%B'));

        Excel::create('Fallas '.$mes, function($excel) {

            $excel->sheet('Fallas', function($sheet) {

                $fallas = PFalla::orderBy('fecha', 'ASC')
                    ->select('fallas.fecha as Fecha','procesos.job as Proceso','fallas.n_caso as N°_Caso',
                        'fallas.tipo as Tipo','fallas.descripcion as Descripción','fallas.estado as Estado',
                        'fallas.solucion as Solución','fallas.r_proceso as ¿Proceso_Relanzado?','procesos.plataforma as Plataforma',
                        'frecuencias.nombre as Frecuencia','turnos.nombre as Turno','tipos.nombre as Responsable')
                    ->join('fallas', 'proceso_falla.FK_Falla', '=', 'fallas.id')
                    ->join('procesos', 'fallas.FK_Proceso', '=', 'procesos.id')
                    ->join('frecuencia_proceso', 'frecuencia_proceso.FK_Proceso', '=', 'procesos.id')
                    ->join('frecuencias', 'frecuencia_proceso.FK_Frecuencia', '=', 'frecuencias.id')
                    ->join('tipos', 'procesos.FK_Tipo', '=', 'tipos.id')
                    ->join('turnos', 'procesos.FK_Turno', '=', 'turnos.id')
                    ->whereBetween('proceso_falla.fecha', [Carbon::now()->startOfMonth()->toDateString(), Carbon::now()->endOfMonth()->toDateString()])
                    ->get();

                $sheet->fromArray($fallas);

                $cantidad=count($fallas);
                $cantidad=$cantidad+1;

                $sheet->cells('A1:L1', function($cells) {
                    $cells->setBackground('#DADADA');
                    $cells->setFontFamily('Calibri Light');
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');

                });

                $sheet->cells("A2:L".$cantidad, function($cells) {
                    $cells->setBackground('#ffffff');
                    $cells->setFontFamily('Calibri Light');
                    $cells->setAlignment('center');
                });

                $sheet->appendRow(array(
                    '', ''
                ));

                $sheet->appendRow(array(
                    'Fecha creación: '.Carbon::now()
                ));

                $sheet->setBorder('A1:L1', 'thin');
                $sheet->setBorder("A2:L".$cantidad, 'thin');
                $sheet->setAutoSize(true);
            });
        })->download('xls');
        return view('Fallas/FallasMensuales');
    }

    public function indexResponsables()
    {
        Excel::create('Responsables' , function($excel) {

            $excel->sheet('Responsables', function($sheet) {

                $responsables=Responsable::orderBy('name','ASC')
                    ->select('users.identificacion as Identificación', 'users.name as Nombres', 'users.lastname as Apellidos',
                        'users.user_red as Usuario_Red', 'users.state as Estado','tipos.nombre as Grupo')
                    ->join('tipos','users.FK_Tipo','=','tipos.id')
                    ->get();

                $sheet->fromArray($responsables);

                $cantidad=count($responsables);
                $cantidad=$cantidad+1;

                $sheet->cells('A1:F1', function($cells) {
                    $cells->setBackground('#DADADA');
                    $cells->setFontFamily('Calibri Light');
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');

                });

                $sheet->cells("A2:F".$cantidad, function($cells) {
                    $cells->setBackground('#ffffff');
                    $cells->setFontFamily('Calibri Light');
                    $cells->setAlignment('center');
                });

                $sheet->appendRow(array(
                    '', ''
                ));

                $sheet->appendRow(array(
                    'Fecha creación: '.Carbon::now()
                ));

                $sheet->setBorder('A1:F1', 'thin');
                $sheet->setBorder("A2:F".$cantidad, 'thin');
                $sheet->setAutoSize(true);
            });
        })->download('xls');
        return view('Fallas/FallasMensuales');
    }

    public function reporteSLADiario()
    {
        $fechaActual=Carbon::now()->toDateString();
        Excel::create('Semáforo'.$fechaActual, function($excel) {


            $excel->sheet('Semaforo', function($sheet) {


                $procesos= Proceso::orderBy('Hora_Entrega', 'ASC')
                    ->select(DB::raw('addtime(procesos.Horario,procesos.t_ejecucion) as Hora_Entrega'),'procesos.nombre as Proceso','procesos.job as Job',
                        'procesos.plataforma as Plataforma','sla.porcentaje as SLA','procesos.servidor as Servidor','procesos.catalogo as Catálogo',
                        'grupos.nombre as Grupo','paises.nombre as Pais','tipos.nombre as Responsable')
                    ->join('tipos','procesos.FK_Tipo','=','tipos.id')
                    ->join('grupos','procesos.FK_Grupo','=','grupos.id')
                    ->join('paises','grupos.FK_Pais','=','paises.id')
                    ->where('procesos.estado','=','Activo')
                    ->where('procesos.semaforo','=','Si');
                $procesosSemaforo= Proceso::orderBy('Hora_Entrega', 'ASC')
                    ->select(DB::raw('addtime(procesos.Horario,procesos.t_ejecucion) as Hora_Entrega'),'procesos.nombre as Proceso','procesos.job as Job',
                        'procesos.plataforma as Plataforma','sla.porcentaje as SLA','proceso_sla.justificacion:sl','procesos.servidor as Servidor','procesos.catalogo as Catálogo',
                        'grupos.nombre as Grupo','paises.nombre as Pais','tipos.nombre as Responsable')
                    ->join('turnos','procesos.FK_Turno', '=', 'turnos.id')
                    ->join('proceso_sla','proceso_sla.FK_Proceso','=','procesos.id')
                    ->join('sla','proceso_sla.FK_SLA','=','sla.id')
                    ->join('tipos','procesos.FK_Tipo','=','tipos.id')
                    ->join('grupos','procesos.FK_Grupo','=','grupos.id')
                    ->join('paises','grupos.FK_Pais','=','paises.id')
                    ->where('procesos.estado','=','Activo')
                    ->where('procesos.semaforo','=','Si')
                    ->where('turnos.nombre','!=', "Noche")
                    ->where('proceso_sla.fecha', '=', Carbon::now()->toDateString());

                $pSLANoche = Proceso::orderBy('Hora_Entrega', 'DESC')
                    ->select(DB::raw('addtime(procesos.Horario,procesos.t_ejecucion) as Hora_Entrega'),'procesos.nombre as Proceso','procesos.job as Job',
                        'procesos.plataforma as Plataforma','sla.porcentaje as SLA','procesos.servidor as Servidor','procesos.catalogo as Catálogo',
                        'grupos.nombre as Grupo','paises.nombre as Pais','tipos.nombre as Responsable')
                    ->join('turnos','procesos.FK_Turno', '=', 'turnos.id')
                    ->join('proceso_sla','proceso_sla.FK_Proceso','=','procesos.id')
                    ->join('sla','proceso_sla.FK_SLA','=','sla.id')
                    ->join('tipos','procesos.FK_Tipo','=','tipos.id')
                    ->join('grupos','procesos.FK_Grupo','=','grupos.id')
                    ->join('paises','grupos.FK_Pais','=','paises.id')
                    ->where('turnos.nombre','=', "Noche")
                    ->where('proceso_sla.fecha', '=', Carbon::yesterday()->toDateString())
                    ->union($procesosSemaforo)
                    ->get();

                $sheet->fromArray($pSLANoche);
                $cantidad=count($pSLANoche);
                $cantidad=$cantidad+1;

                $sheet->cells('A1:F1', function($cells) {
                    $cells->setBackground('#DADADA');
                    $cells->setFontFamily('Calibri Light');
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');

                });

                $sheet->cells("A2:F".$cantidad, function($cells) {
                    $cells->setBackground('#ffffff');
                    $cells->setFontFamily('Calibri Light');
                    $cells->setAlignment('center');
                });

                $sheet->appendRow(array(
                    '', ''
                ));

                $sheet->appendRow(array(
                    'Fecha creación: '.Carbon::now()
                ));

                $sheet->setBorder('A1:F1', 'thin');
                $sheet->setBorder("A2:F".$cantidad, 'thin');
                $sheet->setAutoSize(true);
            });
        })->download('xls');
        return view('Reportes/ProcesosEntregadosDiarios');
    }



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
}
