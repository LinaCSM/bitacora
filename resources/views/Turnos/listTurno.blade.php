@extends('app')
<?php $tipoUsuario=Auth::user()->FK_Tipo?>
@section('Titulo')
    Turnos | Getronics
@stop
@section('contenido')
    <legend>Turnos</legend>

    <div class="panel-body table-responsive" style="margin-bottom: 30px;">
        <table class="table table-striped table-bordered table-hover table-responsive" id="tablaTurnos">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Hora inicio</th>
                <th>Hora final</th>
                <th>Estado</th>
                @if($tipoUsuario=="1" || $tipoUsuario=="2")
                   <th>Opciones</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($turnos as $turno)
                <tr>
                    <td>{{$turno->nombre}}</td>
                    <td>{{$turno->hora_inicio}}</td>
                    <td>{{$turno->hora_final}}</td>
                    @if($turno->estado=="Activo")
                        <td><span class="label label-success">Activo</span></td>
                    @endif
                    @if($turno->estado=="Inactivo")
                        <td><span class="label label-danger">Inactivo</span></td>
                    @endif
                    @if($tipoUsuario=="1" || $tipoUsuario=="2")
                        <td>
                            @if($turno->estado=="Inactivo")
                                <button href="#" class="btn  btn-xs" data-toggle="modal" title="Ver más" data-target="#verTurno{{$turno -> id}}">
                                    <span class="fa fa-search"></span>
                                </button>
                            @endif
                            <button href="#" class="btn  btn-xs" data-toggle="modal" title="Editar" data-target="#editarTurnos{{$turno->id}}"
                            onclick="obtenerIDT({{$turno->id}})">
                                <span class="fa fa-pencil"></span>
                            </button>
                            @if($tipoUsuario=="1" )
                                <button href="#" class="btn  btn-xs" data-toggle="modal" title="Eliminar"
                                        data-target="#eliminarTurno{{$turno->id}}"><span class="fa fa-trash"></span>
                                </button>
                            @endif
                        </td>
                    @endif
                </tr>

            @endforeach
            </tbody>
        </table>
        @if($tipoUsuario=="1" || $tipoUsuario=="2")
            <button href="#" class="btn btn-success" style=" margin-top: 20px; float: right" data-toggle="modal" title="Registrar"
                    data-target="#registrarTurno">Registrar turno </button>
        @endif
    </div>
@stop

@section('modales')
    @foreach($turnos as $turno)
        @include('Turnos.UpdateTurno');
        @include('Turnos.DeleteTurno');
        @include('Turnos.NewTurno');
        @include('Turnos.ViewTurno');
    @endforeach

@stop

@section('script')
    <script type="text/javascript" src="/js/Validaciones/validacionTurno.js"></script>

@stop