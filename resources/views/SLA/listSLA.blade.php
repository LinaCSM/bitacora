@extends('app')
<?php $tipoUsuario=Auth::user()->FK_Tipo?>
@section('Titulo')
    SLA | Getronics
@stop
@section('contenido')
    <legend>SLA</legend>

    <div class="panel-body table-responsive" style="margin-bottom: 30px;">
        <table class="table table-striped table-bordered table-hover table-responsive" id="tablaSLA">
            <thead>
            <tr>
                <th>Porcentaje</th>
                <th>Hora atraso</th>
                <th>Estado</th>
                @if($tipoUsuario=="1" )
                    <th>Opciones</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($sla as $SLA)
                <tr>
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

                    <td>{{$SLA->hora_atraso}}</td>

                    @if($SLA->estado=="Activo")
                        <td><span class="label label-success">Activo</span></td>
                    @endif
                    @if($SLA->estado=="Inactivo")
                        <td><span class="label label-danger">Inactivo</span></td>
                    @endif

                    @if($tipoUsuario=="1" )
                        <td>
                            @if($SLA->estado=="Inactivo")
                                <button href="#" class="btn  btn-xs" data-toggle="modal" title="Ver más" data-target="#verSLA{{$SLA -> id}}">
                                    <span class="fa fa-search"></span>
                                </button>
                            @endif
                            <button href="#" class="btn  btn-xs" data-toggle="modal" title="Editar" data-target="#editarSLA{{$SLA -> id}}" onclick="obtenerID({{$SLA->id}})">
                                <span class="fa fa-pencil"></span>
                            </button>
                            <button href="#" class="btn  btn-xs" data-toggle="modal" title="Eliminar"
                                    data-target="#eliminarSLA{{$SLA -> id}}"><span class="fa fa-trash"></span>
                            </button>
                        </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        @if($tipoUsuario=="1" )
            <button href="#" class="btn btn-success" style="float: right; margin-top: 20px;" data-toggle="modal" title="Registrar"
                data-target="#registrarSLA">Registrar SLA </button>
        @endif
    </div>
@stop

@section('modales')
    @foreach($sla as $SLAS)
        @include('SLA.UpdateSLA');
        @include('SLA.DeleteSLA');
        @include('SLA.NewSLA');
        @include('SLA.ViewSLA');
    @endforeach
@stop

@section('script')
    <script type="text/javascript" src="/js/Validaciones/validarSLA.js"></script>
    <script type="text/javascript">

    </script>
@stop