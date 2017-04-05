@extends('app')
<?php use App\Http\Controllers\SLAController;
use App\Http\Controllers\Controller;?>

@section('contenido')

    <div id="tituloReporte">
        <form class="col-md-12">
            <div class="col-md-5" id="titleR">
                <legend >Procesos Entregados </legend>
            </div>
            <div id="fechaF" class="col-md-3 col-xs-5">
                <input class="form-control" id="fechaFiltro">
            </div>
            <a><i class="fa fa-2x fa-refresh"></i></a>
        </form>
    </div>
<div>
    <button class="btn btn-info" id="btnFiltro">Filtrar <span class="fa fa-filter"></span> </button>

    <a id="btnTodos" class="btn btn-info"  style="display: none" href="{{route('ProcesosEntregadosDiarios')}}"> Todos</a>
</div>


    <div id="filtros" style="display: none;">
        <h6>Filtrar por:</h6>
    </div>
    <?php $plataforma= Controller::getEnumValues('procesos','plataforma')?>
    <div id="formularioFiltros" style="margin-top: -6px; display: none;">
        {!! Form::open(['action'=>'ReporteController@search','class'=>'form-inline'])!!}
        <div class="form-group">
            <div class="col-md-12">
                <select id="searchResponsable" name="searchResponsable" class="form-control">
                    <option selected="true" disabled="true">-- Responsable --</option>
                    @foreach($tipos as $Tipo)
                        <option value="{{$Tipo->id}}">{{$Tipo->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <select id="searchPlataforma" name="searchPlataforma" class="form-control">
                    <option selected="true" disabled="true">-- Plataforma --</option>
                    @foreach($plataforma as $Plataforma)
                        <option value="{{$Plataforma}}">{{$Plataforma}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class='input-group date'>
                    <select id="searchTurno" name="searchTurno" class="form-control">
                        <option selected="true" disabled="true">-- Turno --</option>
                        @foreach($turnos as $Turno)
                            <option value="{{$Turno->id}}">{{$Turno->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <button id="btnSearch" class="btn btn-xs btn-success"><span class="fa fa-search"></span></button>
        {!! Form::close()!!}
    </div>

    @if(Session::has('flash_message'))
        <div id="mensajeAlerta" class="alert alert-success">
            {{ Session::get('flash_message') }}
        </div>
    @endif
    @if(Session::has('error_message'))
        <div id="mensajeAlerta" class="alert alert-warning">
            {{ Session::get('error_message') }}
        </div>
    @endif


    <div id="tablaSDiario" class="panel-body table-responsive">
        <table class="table table-striped table-bordered table-hover" id="tablaSemaforoDiario">
            <thead>
            <tr>
                <th>Hora entrega</th>
                <th>Proceso</th>
                <th>SLA</th>
                <th>Plataforma</th>
                <th>Responsable</th>
                <th>Opciones</th>
                <th>Opci</th>
            </tr>
            </thead>
            <tbody>
            @foreach($procesosSemaforo as $semaforo)

                <?php $sla=SLAController::buscarSLA($semaforo->idP)?>

                <tr>
                    <td>{{$semaforo->horaEntrega}}</td>
                    <td>{{$semaforo->nombre}}</td>
                    @if($sla=='[]')
                        <td>--</td>
                    @else
                        @foreach($sla as $SLA)
                            @if($SLA->porcentaje>="100")
                                <td><span class="label label-success">{{$SLA->porcentaje}}</span></td>
                            @endif
                            @if($SLA->porcentaje>="75" && $SLA->porcentaje<"100")
                                <td><span class="label label-info">{{$SLA->porcentaje}}</span></td>
                            @endif
                            @if($SLA->porcentaje>="50" && $SLA->porcentaje<"75")
                                <td><span class="label label-yellow">{{$SLA->porcentaje}}</span></td>
                            @endif
                            @if($SLA->porcentaje>="25" && $SLA->porcentaje<"50")
                                <td><span class="label label-warning">{{$SLA->porcentaje}}</span></td>
                            @endif
                            @if($SLA->porcentaje>="0" && $SLA->porcentaje<"25")
                                <td><span class="label label-danger">{{$SLA->porcentaje}}</span></td>
                            @endif
                        @endforeach
                    @endif
                    <td>{{$semaforo->plataforma}}</td>
                    <td>{{$semaforo->responsable}}</td>
                    <td>
                        <button href="#" class="btn  btn-xs" data-toggle="modal" title="Ver más" data-target="#verProceso{{$semaforo -> idP}}">
                            <span class="fa fa-search"></span>
                        </button>
                        <button href="#" class="btn  btn-xs" data-toggle="modal" title="Ver entregables" data-target="#verEntregables{{$semaforo -> idP}}">
                            <span class="fa fa-list"></span>
                        </button>
                    </td>
                    <td>
                        {{$semaforo->porcentaje}}
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="form-group">
            <label class="control-label" for="nProceso">Exportar a:  </label>
            <button id="excel" class="botonimagenexcel" ></button>
        </div>

    </div>




@stop

@section('modales')
    @foreach($procesosSemaforo as $Semaforo)
        @include('Reportes.ViewProceso')
        @include('Reportes.ViewEntregables')
    @endforeach
@stop

@section('script')
    <script type="text/javascript" src="/js/Validaciones/validarReportes.js"></script>
@stop


