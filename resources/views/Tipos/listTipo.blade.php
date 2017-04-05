@extends('app')
<?php $tipoUsuario=Auth::user()->FK_Tipo?>
@section('Titulo')
    Tipos | Getronics
@stop
@section('contenido')
@if($tipoUsuario=="1")
    <legend>Tipos de usuarios</legend>

    <div class="panel-body table-responsive" style="margin-bottom: 30px;">
        <table class="table table-striped table-bordered table-hover table-responsive" id="tablaTipos">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tipos as $Tipo)
            <tr>
                <td>{{$Tipo->nombre}}</td>

                @if($Tipo->estado=="Activo")
                    <td><span class="label label-success">Activo</span></td>
                @endif
                @if($Tipo->estado=="Inactivo")
                    <td><span class="label label-danger">Inactivo</span></td>
                    @endif
                <td>
                    @if($Tipo->estado=="Inactivo")
                        <button href="#" class="btn  btn-xs" data-toggle="modal" title="Ver más" data-target="#verTipo{{$Tipo -> id}}">
                            <span class="fa fa-search"></span>
                        </button>
                    @endif
                    <button href="#" class="btn  btn-xs" data-toggle="modal" title="Editar" data-target="#editarTipo{{$Tipo->id}}" onclick="obtenerID({{$Tipo->id}})">
                        <span class="fa fa-pencil"></span>
                    </button>
                    @if($tipoUsuario=="1" )
                        <button href="#" class="btn  btn-xs" data-toggle="modal" title="Eliminar"
                                data-target="#eliminarTipo{{$Tipo->id}}"><span class="fa fa-trash"></span>
                        </button>
                    @endif
                </td>

            </tr>
            @endforeach
            </tbody>
        </table>
        <button href="#" class="btn btn-success" style="float: right;  margin-top: 20px;" data-toggle="modal" title="Registrar"
                data-target="#registrarTipo">Registrar tipo </button>
    </div>
@else
    <legend>¡Error!</legend>

    <div id="mensajePermisos" class="alert alert-danger">
        Permisos insuficientes.
    </div>
@endif
@stop

@section('modales')
    @foreach($tipos as $tipo)
        @include('Tipos.UpdateTipo')
        @include('Tipos.DeleteTipo')
        @include('Tipos.NewTipo')
        @include('Tipos.ViewTipo')
    @endforeach
@stop

@section('script')
    <script type="text/javascript" src="/js/Validaciones/validarTipo.js"></script>
@stop