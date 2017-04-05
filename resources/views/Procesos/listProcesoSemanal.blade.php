@extends('app')
<?php $tipoUsuario=Auth::user()->FK_Tipo?>

@section('Titulo')
    Procesos semanales | Getronics
@stop
@section('contenido')

    <legend>Procesos semanales</legend>
    @if($tipoUsuario=="1" || $tipoUsuario=="2" || $tipoUsuario=="7")
    <button class="btn btn-info" id="btnFiltro">Filtrar <span class="fa fa-filter"></span> </button>
    <button class="btn btn-info" id="btnTodos" style="display: none">Todos</button>

    <div id="filtros" style="display: none;">
        <h6>Filtrar por:</h6>
    </div>

    <div id="formularioFiltros" style="display: none;">
        <form class="form-inline">
            <div class="form-group">
                <div class="col-md-12">
                    <select id="responsable" name="responsable" class="form-control">
                        <option selected="true" disabled="true">-- Responsable --</option>
                        <option>A17X24</option>
                        <option>A17X24N</option>
                        <option>A1-AC</option>
                        <option>A1-WG</option>
                    </select>
                </div>
            </div>


            <select id="responsableEProceso" name="responsableEProceso" class="form-control" tabindex="17">

            </select>

            <div class="form-group">
                <div class="col-md-12">
                    <select id="plataforma" name="Plataforma" class="form-control">
                        <option selected="true" disabled="true">Plataforma</option>
                        <option>Oracle</option>
                        <option>Netezza</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <select id="servidor" name="servidor" class="form-control">
                        <option selected="true" disabled="true">Servidor</option>
                        <option>WINTSERV01</option>
                        <option>WDTMB04</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <select id="estado" name="estado" class="form-control">
                        <option selected="true" disabled="true">Estado</option>
                        <option>Activo</option>
                        <option>Inactivo</option>
                        <option>Bloqueado</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <select id="grupo" name="grupo" class="form-control">
                        <option selected="true" disabled="true">Grupo</option>
                        <option>Prepago</option>
                        <option>Clientes</option>
                        <option>Comisiones</option>
                    </select>
                </div>
            </div>
            <button id="btnSearch" class="btn btn-xs btn-success"><span class="fa fa-search"></span></button>
        </form>
    </div>
    @endif
    <div class="panel-body table-responsive">
        <table class="table table-striped table-bordered table-hover table-responsive" id="tablaProcesos">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Plataforma</th>
                <th>Turno</th>
                <th>Servidor Catalogo</th>
                <th>Grupo Pais</th>
                <th>Responsable</th>
                <th>Estado</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody>

            @foreach($procesosSemanales as $Proceso)
                <tr>
                    <td>{{$Proceso->nombre}}</td>
                    <td>{{$Proceso->plataforma}}</td>
                    <td>{{$Proceso->Turno}}</td>
                    <td>{{$Proceso->servidor}} {{$Proceso->catalogo}}</td>
                    <td>{{$Proceso->Grupo}} {{$Proceso->Pais}}</td>
                    <td>{{$Proceso->Tipo}}</td>
                    @if($Proceso->estado=="Activo")
                        <td><span class="label label-success">Activo</span></td>
                    @endif
                    @if($Proceso->estado=="Inactivo")
                        <td><span class="label label-warning">Inactivo</span></td>
                    @endif
                    @if($Proceso->estado=="Bloqueado")
                        <td><span class="label label-danger">Bloqueado</span></td>
                    @endif
                    <td>
                        <button href="#" class="btn  btn-xs" data-toggle="modal" title="Ver más" data-target="#verProceso{{$Proceso -> id}}">
                            <span class="fa fa-search"></span>
                        </button>
                        <button href="#" class="btn  btn-xs" data-toggle="modal" title="Ver entregables" data-target="#verEntregables{{$Proceso -> id}}">
                            <span class="fa fa-list"></span>
                        </button>
                        @if($tipoUsuario=="5" || $tipoUsuario=="6")
                            <button href="#" class="btn  btn-xs" data-toggle="modal" title="Cambiar responsable" data-target="#cambiarResponsable{{$Proceso -> id}}">
                                <span class="fa fa-user-plus"></span>
                            </button>
                        @endif
                        @if($tipoUsuario=="1" || $tipoUsuario=="2")
                        <button href="#" class="btn  btn-xs" data-toggle="modal" title="Editar" data-target="#editarProceso{{$Proceso -> id}}"
                                onclick="obtenerID({{$Proceso->id}})">
                            <span class="fa fa-pencil"></span>
                        </button>
                        <button href="#" class="btn  btn-xs" data-toggle="modal" title="Cambiar estado" data-target="#cambiarEstadoProceso{{$Proceso -> id}}"
                                onclick="obtenerID({{$Proceso->id}})">
                            <span class="fa fa-refresh"></span>
                        </button>
                        <button href="#" class="btn  btn-xs" data-toggle="modal" title="Eliminar" data-target="#eliminarProceso{{$Proceso -> id}}">
                            <span class="fa fa-trash"></span>
                        </button>
                        @endif
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

    @if($tipoUsuario=="1" || $tipoUsuario=="2")
    <a class="btn btn-success registrar" style="float:right" href="{{url('RegistrarProceso')}}">Registrar proceso</a>
    @endif
    @if($tipoUsuario=="1" || $tipoUsuario=="2" || $tipoUsuario=="7")
    <div class="form-group" style="width: 200px">
        <form action="{{route('downloadProcesosSemanales')}}">
            <label class="control-label">Exportar a:  </label>
            <button id="excel" class="botonimagenexcel" type="submit"></button>
        </form>
    </div>
    @endif
@stop

@section('modales')

    @foreach($procesosSemanales as $Proceso)
        @include('Procesos.ViewProceso')
        @include('Procesos.UpdateProceso')
        @include('Procesos.DeleteProceso')
        @include('Procesos.ModalFrecuenciaSE')
        @include('Procesos.ModalFrecuenciaME')
        @include('Procesos.ModalEntregables')
        @include('Procesos.ModalCambioEstado')
        @include('Procesos.ModalCambioResponsable')
    @endforeach
@stop

@section('script')

    <script type="text/javascript" src="/js/Validaciones/validacionFrecuencia.js"></script>
    <script type="text/javascript" src="/js/Validaciones/validarInformacionEstado.js"></script>
    <script type="text/javascript" src="/js/Validaciones/validacionProceso.js"></script>

    <script type="text/javascript">

        $(document).ready(function () {
            $('#tablaProcesos').DataTable();
            $('#t_ejecucionE').datetimepicker({
                format: 'LT'
            });

            $('#h_ejecucionE').datetimepicker({
                format: 'LT'
            });
            $("li").removeClass("active");
            $("#proceso").addClass("active");
        });



        $('#btnFiltro').click(function() {
            document.getElementById('filtros').style.display = 'block';
            document.getElementById('formularioFiltros').style.display = 'block';
            document.getElementById('btnFiltro').style.display = 'none';
            document.getElementById('btnTodos').style.display = 'block';
        });

        $('#btnTodos').click(function() {
            document.getElementById('filtros').style.display = 'none';
            document.getElementById('formularioFiltros').style.display = 'none';
            document.getElementById('btnFiltro').style.display = 'block';
            document.getElementById('btnTodos').style.display = 'none';
        });
    </script>
@stop
