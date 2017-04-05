@extends('app')
<?php $tipoUsuario=Auth::user()->FK_Tipo?>
@section('Titulo')
    Grupos | Getronics
@stop
@section('contenido')

    <legend>Grupos</legend>

    <div class="panel-body table-responsive">
        <table class="table table-striped table-bordered table-hover table-responsive" id="tablaGrupos">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>País</th>
                <th>Estado</th>
                @if($tipoUsuario=="1" || $tipoUsuario=="2")
                    <th>Opciones</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($Grupo as $grupo)
                <tr>
                    <td>{{$grupo->nombre}}</td>
                    <td>{{$grupo->descripcion}}</td>
                    <td>{{$grupo->pais}}</td>
                    @if($grupo->estado=="Activo")
                        <td><span class="label label-success">Activo</span></td>
                    @endif
                    @if($grupo->estado=="Inactivo")
                        <td><span class="label label-danger">Inactivo</span></td>
                    @endif

                    @if($tipoUsuario=="1" || $tipoUsuario=="2")
                        <td>
                            @if($grupo->estado=="Inactivo")
                                <button href="#" class="btn  btn-xs" data-toggle="modal" title="Ver más" data-target="#verGrupo{{$grupo -> id}}">
                                    <span class="fa fa-search"></span>
                                </button>
                            @endif
                            <button href="#" class="btn  btn-xs" data-toggle="modal" title="Editar" data-target="#editarGrupo{{$grupo -> id}}" onclick="obtenerID({{$grupo->id}})">
                                <span class="fa fa-pencil"></span>
                            </button>
                            @if($tipoUsuario=="1" )
                                <button href="#" class="btn  btn-xs" data-toggle="modal" title="Eliminar"
                                        data-target="#eliminarGrupo{{$grupo -> id}}"><span class="fa fa-trash"></span>
                                </button>
                            @endif
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
    @if($tipoUsuario=="1" || $tipoUsuario=="2")
        <button class="btn btn-success registrar" data-toggle="modal" title="Registrar" data-target="#registrarGrupo" style="float: right">Registrar grupo </button>
    @endif
@stop

@section('modales')
    @foreach($Grupo as $grupos)
        @include('Grupos.NewGrupo');
        @include('Grupos.UpdateGrupo');
        @include('Grupos.DeleteGrupo');
        @include('Grupos.ViewGrupo');
    @endforeach
@stop

@section('script')
    <script type="text/javascript" src="/js/Validaciones/validarGrupo.js"></script>
@stop
