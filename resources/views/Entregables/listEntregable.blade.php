@extends('app')
<?php $tipoUsuario=Auth::user()->FK_Tipo?>
@section('Titulo')
    Entregables | Getronics
@stop
@section('contenido')
    <legend>Entregables</legend>
    @if($tipoUsuario=="1" || $tipoUsuario=="2" || $tipoUsuario=="7")
        <button class="btn btn-info" id="btnTodos">Todos</button>
        <button class="btn btn-info" id="btnFiltro">Filtrar <span class="fa fa-filter"></span> </button>
        <div id="filtros" style="display: none;">
            <h6>Filtrar por:</h6>
        </div>
        <div id="formularioFiltros" style="margin-top: -6px; display: none;">
            <form class="form-inline">
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="text" id="searchProceso" name="searchProceso" class="form-control input-md" placeholder="-- Proceso --">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <select id="searchTipoEntregable" name="searchTipoEntregable" class="form-control">
                            <option selected="true" disabled="true">-- Tipo entregable --</option>
                            <option>Archivo excel</option>
                            <option>Archivo plano</option>
                            <option>Correo</option>
                            <option>Cubo</option>
                            <option>Tablas en oracle</option>
                            <option>Reporte</option>
                            <option>Reporte excel</option>
                            <option>Reporte IBM COGNOS</option>
                            <option>Reporte ECON extension CSV</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <select id="searchResponsable" name="searchResponsable" class="form-control">
                            <option selected="true" disabled="true">-- Responsable --</option>
                            <option>A17X24</option>
                            <option>A17X24N</option>
                            <option>A1-AC</option>
                            <option>A1-WG</option>
                        </select>
                    </div>
                </div>
                <button id="btnSearch" class="btn btn-xs btn-success"><span class="fa fa-search"></span></button>
            </form>
        </div>
    @endif

    <div id="tablaTodos" class="panel-body table-responsive" style="margin-bottom: 30px;">
        <div id="tablaEntregables_wrapper" class="dataTables_wrapper no-footer" style="width: 1340px">
        <table class="table table-striped table-bordered table-hover" id="tablaEntregables" >
            <thead>
            <tr>
                <th>Proceso</th>
                <th>Tipo entregable</th>
                <th>Ruta</th>
                <th>Hora aprox. entrega</th>
                <th>Responsable</th>
                <th>Estado</th>
                <th>Opc.</th>
            </tr>
            </thead>
            <tbody>
            @foreach($entregables as $Entregable)
                <tr>
                    <td>{{$Entregable->Proceso}}</td>
                    <td>{{$Entregable->tipo}}</td>
                    <td>{{$Entregable->ruta}}</td>
                    <td>{{$Entregable->hora_aproximada}}</td>
                    <td>{{$Entregable->Responsable}}</td>
                    @if($Entregable->estado=="Activo")
                        <td><span class="label label-success">Activo</span></td>
                    @endif

                    @if($Entregable->estado=="Inactivo")
                        <td><span class="label label-warning">Inactivo</span></td>
                    @endif

                    @if($Entregable->estado=="Bloqueado")
                        <td><span class="label label-danger">Bloqueado</span></td>
                     @endif

                    <td>
                        <button href="#" class="btn  btn-xs" data-toggle="modal" title="Ver más"
                                data-target="#verEntregable{{$Entregable->idP}}"><span class="fa fa-search"></span>
                        </button>
                        @if($tipoUsuario=="1" || $tipoUsuario=="2")
                            <button href="#" class="btn  btn-xs" data-toggle="modal" title="Editar"
                                 onclick="obtenerID({{$Entregable->id}})" data-target="#editarEntregable{{$Entregable->id}}"><span class="fa fa-pencil"></span>
                            </button>
                            <button href="#" class="btn  btn-xs" data-toggle="modal" title="Eliminar"
                                    data-target="#eliminarEntregable{{$Entregable->id}}"><span class="fa fa-trash"></span>
                            </button>
                            <button href="#" class="btn  btn-xs" data-toggle="modal" title="Cambiar estado"
                                    onclick="obtenerID({{$Entregable->id}})" data-target="#cambiarEstadoEntregable{{$Entregable->id}}"><span class="fa fa-refresh"></span>
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
    </div>
    @if($tipoUsuario=="1" || $tipoUsuario=="2")
    <a class="btn btn-success" style="float: right" href="{{url('Entregables/NewEntregable')}}"> Registrar entregable</a>
    @endif
    @if($tipoUsuario=="1" || $tipoUsuario=="2" || $tipoUsuario=="7")
        <div class="form-group" style="width: 200px">
            <form action="{{route('downloadEntregables')}}">
                <label class="control-label">Exportar a:  </label>
                <button id="excel" class="botonimagenexcel" type="submit"></button>
            </form>
        </div>
    @endif
@endsection

@section('modales')
    @foreach($entregables as $Entregable)
        @include('Entregables.ViewEntregable');
        @include('Entregables.UpdateEntregable');
        @include('Entregables.DeleteEntregable');
        @include('Entregables.ModalCambioEstado');

    @endforeach
@stop

@section('script')
    <script type="text/javascript" src="/js/Validaciones/validacionListEntregable.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("li").removeClass("active");
            $("#entregable").addClass("active");
        });
    </script>

@stop


