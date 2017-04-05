@extends('app')
<?php $tipoUsuario=Auth::user()->FK_Tipo?>
@section('Titulo')
    Responsables | Getronics
@stop
@section('contenido')

    <legend>Responsables</legend>

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
                    <button class="btn btn-primary">A17X24</button>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <button class="btn btn-primary">A17X24N</button>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <button class="btn btn-primary">A1-AC</button>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <button class="btn btn-primary">A1-WG</button>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <button class="btn btn-primary">A1-WG</button>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <button class="btn btn-primary">Analistas 2</button>
                </div>
            </div>
        </form>
        </div>
@endif
        <div class="panel-body table-responsive">
            <table class="table table-striped table-bordered table-hover table-responsive" id="tablaResponsables">
                <thead>
                <tr>
                    <th>Identificación</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Usuario de red</th>
                    <th>Grupo</th>
                    <th>Estado</th>
                    @if($tipoUsuario=="1" || $tipoUsuario=="2" || $tipoUsuario=="7")
                        <th>Opciones</th>
                    @endif
                </tr>
                </thead>


                <tbody>
                @foreach($responsables as $Responsable)
                    <tr>
                        <td>{{$Responsable->identificacion}}</td>
                        <td>{{$Responsable->name}}</td>
                        <td>{{$Responsable->lastname}}</td>
                        <td>{{$Responsable->user_red}}</td>
                        <td>{{$Responsable->FK_Tipo}}</td>
                        @if($Responsable->state=="Activo")
                            <td><span class="label label-success">Activo</span></td>
                        @endif
                        @if($Responsable->state=="Inactivo")
                            <td><span class="label label-danger">Inactivo</span></td>
                        @endif
                        @if($tipoUsuario=="1" || $tipoUsuario=="2" || $tipoUsuario=="7")
                            <td>

                                @if($Responsable->state=="Inactivo")
                                    <button href="#" class="btn  btn-xs" data-toggle="modal" title="Ver más" data-target="#verResponsable{{$Responsable -> id}}">
                                        <span class="fa fa-search"></span>
                                    </button>
                                @endif

                                <button href="#" class="btn  btn-xs" data-toggle="modal" title="Editar" data-target="#editarResponsable{{$Responsable -> id}}" onclick="obtenerIDR({{$Responsable -> id}})">
                                    <span class="fa fa-pencil"></span>
                                </button>
                                <button href="#" class="btn  btn-xs" data-toggle="modal" title="Cambiar estado"
                                        data-target="#cambiarEstadoResponsable{{$Responsable->id}}" onclick="obtenerIDR({{$Responsable -> id}})"><span class="fa fa-refresh"></span>
                                </button>
                                @if($tipoUsuario=="1")
                                    <button href="#" class="btn  btn-xs" data-toggle="modal" title="Eliminar" data-target="#eliminarResponsable{{$Responsable->id}}">
                                        <span class="fa fa-trash"></span>
                                    </button>
                                @endif
                            </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@if($tipoUsuario=="1" || $tipoUsuario=="2" || $tipoUsuario=="7")
<button href="#" class="btn btn-success"data-toggle="modal" title="Registrar"
data-target="#registrarResponsable" style="float:right">Registrar responsable </button>

<div class="form-group" style="width: 200px">
<form action="{{route('downloadResponsables')}}">
<label class="control-label">Exportar a:  </label>
<button id="excel" class="botonimagenexcel" type="submit"></button>
</form>
</div>
@endif
@stop

@section('modales')
@foreach($responsables as $responsable)
@include('Usuarios.UpdateUsuario')
@include('Usuarios.ModalCambioEstado')
@include('Usuarios.DeleteUsuario')
@include('Usuarios.NewUsuario')
@include('Usuarios.ViewUsuario')
@endforeach


@stop

@section('script')

<script type="text/javascript" src="/js/Validaciones/validacionUsuarios.js"></script>
@stop
