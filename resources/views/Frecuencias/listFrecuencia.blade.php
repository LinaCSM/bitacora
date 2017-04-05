@extends('app')
<?php $tipoUsuario=Auth::user()->FK_Tipo?>
@section('Titulo')
    Frecuencias | Getronics
@stop
@section('contenido')
@if($tipoUsuario=="1" || $tipoUsuario=="2")
    <legend>Frecuencias</legend>

    <div class="panel-body table-responsive" style="margin-bottom: 30px;">
        <table class="table table-striped table-bordered table-hover table-responsive" id="tablaFrecuencia">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody>

            @foreach($Frecuencia as $frecuencia)
                <tr>
                    <td>{{$frecuencia->nombre}}</td>
                    @if($frecuencia->estado=="Activo")
                        <td><span class="label label-success">Activo</span></td>
                    @endif
                    @if($frecuencia->estado=="Inactivo")
                        <td><span class="label label-danger">Inactivo</span></td>
                    @endif
                    <td>
                        @if($frecuencia->estado=="Inactivo")
                            <button href="#" class="btn  btn-xs" data-toggle="modal" title="Ver más" data-target="#verFrecuencia{{$frecuencia -> id}}">
                                <span class="fa fa-search"></span>
                            </button>
                        @endif
                        <button href="#" class="btn  btn-xs" data-toggle="modal" title="Editar" data-target="#editarFrecuencia{{$frecuencia->id}}" onclick="obtenerID({{$frecuencia->id}})">
                            <span class="fa fa-pencil"></span>
                        </button>
                        @if($tipoUsuario=="1" )
                            <button href="#" class="btn  btn-xs" data-toggle="modal" title="Eliminar"
                                    data-target="#eliminarFrecuencia{{$frecuencia->id}}"><span class="fa fa-trash"></span>
                            </button>
                        @endif

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @if($tipoUsuario=="1" || $tipoUsuario=="2")
            <button href="#" class="btn btn-success" style="float:right; margin-top: 20px;" data-toggle="modal" title="Registrar"
                data-target="#registrarFrecuencia">Registrar frecuencia </button>
        @endif
    </div>
@else
    <legend>¡Error!</legend>

    <div id="mensajePermisos" class="alert alert-danger">
        Permisos insuficientes.
    </div>
@endif
@stop

@section('modales')
    @foreach($Frecuencia as $frecuencias)
        @include('Frecuencias.UpdateFrecuencia');
        @include('Frecuencias.DeleteFrecuencia');
        @include('Frecuencias.NewFrecuencia');
        @include('Frecuencias.ViewFrecuencia');
    @endforeach
@stop

@section('script')

    <script type="text/javascript" src="/js/Validaciones/validarFrecuencia.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#tablaFrecuencia').DataTable();
            $("li").removeClass("active");
            $("#general").addClass("active");
        });

    </script>
@stop