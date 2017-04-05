@extends('app')
<?php use App\Http\Controllers\Controller;?>
@section('contenido')
    <legend>Procesos Entregados</legend>

    <button class="btn btn-info" id="btnFiltro">Filtrar <span class="fa fa-filter"></span> </button>
    <a id="btnTodos" class="btn btn-info"  style="display: none" href="{{route('ProcesosEntregadosGeneral')}}"> Todos</a>

    <div id="filtros" style="display: none;">
        <h6>Filtrar por:</h6>
    </div>
    <?php $plataforma= Controller::getEnumValues('procesos','plataforma')?>

    <div id="formularioFiltros" style="margin-top: -6px; display: none;">
        {!! Form::open(['action'=>'ReporteController@searchGeneral','class'=>'form-inline'])!!}
            <div class="form-group" style="padding-left: 0px !important;">
                <div class="col-md-12">
                    <input type="text" id="searchFechaProcesoI" name="searchFechaProcesoI" class="form-control" placeholder="-- Desde --">
                </div>
            </div>

            <div class="form-group" style="padding-left: 0px !important;">
                <div class="col-md-12">
                    <input type="text" id="searchFechaProcesoF" name="searchFechaProcesoF" class="form-control" placeholder="-- Hasta --" >
                </div>
            </div>

            <div class="form-group" style="padding-left: 0px !important;">
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

            <button id="btnSearch" class="btn btn-xs btn-success" ><span class="fa fa-search"></span></button>
        {!! Form::close()!!}
    </div>

    <div class="panel-body table-responsive">
        <table class="table table-striped table-bordered table-hover" id="tablaEntregablesR">
            <thead>
            <tr>
                <th>Fecha</th>
                <th>Hora entrega</th>
                <th>Proceso</th>
                <th>SLA</th>
                <th>Plataforma</th>
                <th>Responsable</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($procesosSemaforoG as $semaforo)
                <tr>
                    <td>{{$semaforo->fecha}}</td>
                    <td>{{$semaforo->horaEntrega}}</td>
                    <td>{{$semaforo->nombre}}</td>
                    @if($semaforo->porcentaje>="100")
                        <td><span class="label label-success">{{$semaforo->porcentaje}}</span></td>
                    @endif
                    @if($semaforo->porcentaje>="75" && $semaforo->porcentaje<"100")
                        <td><span class="label label-info">{{$semaforo->porcentaje}}</span></td>
                    @endif
                    @if($semaforo->porcentaje>="50" && $semaforo->porcentaje<"75")
                        <td><span class="label label-yellow">{{$semaforo->porcentaje}}</span></td>
                    @endif
                    @if($semaforo->porcentaje>="25" && $semaforo->porcentaje<"50")
                        <td><span class="label label-warning">{{$semaforo->porcentaje}}</span></td>
                    @endif
                    @if($semaforo->porcentaje>="0" && $semaforo->porcentaje<"25")
                        <td><span class="label label-danger">{{$semaforo->porcentaje}}</span></td>
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

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


    <div class="form-group">
        <label class="control-label" for="nProceso">Exportar a:  </label>
        <button id="excel" class="botonimagenexcel"  value=""></button>
    </div>
@stop

@section('modales')
    @foreach($procesosSemaforoG as $Semaforo)
        @include('Reportes.ViewProceso')
        @include('Reportes.ViewEntregables')
    @endforeach
@stop

@section('script')

    <script type="text/javascript" src="/js/Validaciones/validarReportes.js"></script>

@stop


