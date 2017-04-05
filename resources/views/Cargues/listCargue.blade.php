@extends('app')
<?php $tipoUsuario=Auth::user()->FK_Tipo?>
@section('Titulo')
    Cargues | Getronics
@stop

@section('contenido')
@if($tipoUsuario=="1" || $tipoUsuario=="2" || $tipoUsuario=="7")
    <legend>Cargues</legend>

    <button class="btn btn-info" id="btnFiltro">Filtrar <span class="fa fa-filter"></span> </button>
    <button class="btn btn-info" id="btnTodos" style="display: none">Todos</button>

    <div id="filtros" style="display: none;">
        <h6>Filtrar por:</h6>
    </div>
    <div id="formularioFiltros" style="display: none; margin-top: -6px;">
        <form id class="form-inline">
            <div class="form-group">
                <div class="col-md-12">
                    <input type="text" id="searchTipoArchivo" name="searchTipoArchivo" class="form-control input-md" placeholder="-- Tipo archivo--">
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

            <div class="form-group">
                <div class="col-md-12">
                    <select id="searchPlataformaCargue" name="searchPlataformaCargue" class="form-control">
                        <option selected="true" disabled="true">-- Plataforma --</option>
                        <option>Oracle</option>
                        <option>Netezza</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <select id="searchEstadoCargue" name="searchEstadoCargue" class="form-control">
                        <option selected="true" disabled="true">-- País --</option>
                        <option>Colombia</option>
                        <option>Panamá</option>
                    </select>
                </div>
            </div>
            <button id="btnSearch" class="btn btn-xs btn-success"><span class="fa fa-search"></span></button>
        </form>
    </div>

    <div class="panel-body table-responsive" style="margin-bottom: 30px;">
        <table class="table table-striped table-bordered table-hover" id="tablaCargues">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Grupo Pais</th>
                <th>Servidor Catalogo</th>
                <th>Ruta</th>
                <th>Periodicidad</th>
                <th>Responsable</th>
                <th>Opc.</th>
            </tr>
            </thead>
            <tbody>

            @foreach($cargues as $Cargue)

                <tr>
                    <td>{{$Cargue->nombre}}</td>
                    <td>{{$Cargue->Grupo}} {{$Cargue->Pais}}</td>
                    <td>{{$Cargue->servidor}} {{$Cargue->catalogo}}</td>
                    <td>{{$Cargue->ruta}}</td>
                    <td>{{$Cargue->periodicidad}} desde las {{$Cargue->hora_ejecucion}}</td>
                    <td>{{$Cargue->Responsable}}</td>
                    <td>
                        <button href="#" class="btn  btn-xs" data-toggle="modal" title="Ver más"
                                data-target="#verCargue{{$Cargue->id}}"><span class="fa fa-search"></span>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    @if($tipoUsuario=="1" || $tipoUsuario=="2")
        <a class="btn btn-success " style="float:right" href="{{url('RegistrarCargue')}}"> Registrar cargue</a>
    @endif
    <div class="form-group" style="width: 200px">
        <form action="{{route('downloadCargues')}}">
            <label class="control-label">Exportar a:  </label>
            <button id="excel" class="botonimagenexcel" type="submit"></button>
        </form>
    </div>

@else
    <legend>¡Error!</legend>

    <div id="mensajePermisos" class="alert alert-danger">
        Permisos insuficientes.
    </div>
@endif
@stop

@section('modales')
    @foreach($cargues as $Cargue)
        @include('Cargues/ViewCargue')
    @endforeach
@stop

@section('script')
    <script type="text/javascript">

        function cambiarEstado(estado) {
            if (estado === 'represado' || estado === 'detenido' || estado === 'fallando') {
                document.getElementById('justificacionEstado').style.display = 'block';
            } else {
                document.getElementById('justificacionEstado').style.display = 'none';
            }
        };

        $(document).ready(function () {
            $('#tablaCargues').dataTable();
            $("li").removeClass("active");
            $("#cargue").addClass("active");
        });

        $('#btnFiltro').click(function traerFiltros() {
            document.getElementById('filtros').style.display = 'block';
            document.getElementById('formularioFiltros').style.display = 'block';
            document.getElementById('btnFiltro').style.display = 'none';
            document.getElementById('btnTodos').style.display = 'block';
        });

        $('#btnTodos').click(function traerFiltros() {
            document.getElementById('filtros').style.display = 'none';
            document.getElementById('formularioFiltros').style.display = 'none';
            document.getElementById('btnFiltro').style.display = 'block';
            document.getElementById('btnTodos').style.display = 'none';
        });
    </script>
@stop


