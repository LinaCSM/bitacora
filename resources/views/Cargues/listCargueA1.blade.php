@extends('app')
<?php $tipoUsuario=Auth::user()->FK_Tipo?>
@section('Titulo')
    Cargues | Getronics
@stop
@section('contenido')
@if($tipoUsuario=="1" || $tipoUsuario=="2" || $tipoUsuario=="3" ||$tipoUsuario=="4" ||$tipoUsuario=="5"||$tipoUsuario=="6")
    <legend id="tColombia">Cargues colombia</legend>
    <legend id="tPanama" style="display: none">Cargues panamá</legend>

    <button class="btn btn-info" id="btnPanama" >Panamá</button>
    <button class="btn" id="btnColombia">Colombia</button>

    @if(Session::has('flash_message'))
        <div id="mensajeAlerta" class="alert alert-success">
            {{ Session::get('flash_message') }}
        </div>
    @endif

    @if(Session::has('error_message'))
        <div id="mensajeAlerta" class="alert alert-warning">
            {{ Session::get('error_message') }}
        </div>
    @endif

    <div id="tablaColombia" class="panel-body table-responsive" style="margin-bottom: 30px;">
        <input type="hidden" id="tipoU" value="{{$tipoUsuario}}">
        <table class="table table-striped table-bordered table-hover" id="tablaCarguesColombia">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Grupo</th>
                <th>Servidor Catalogo</th>
                <th>Ruta</th>
                <th>Periodicidad</th>
                <th>Estado</th>
                <th>Opc.</th>
            </tr>
            </thead>
            <tbody>

            @foreach($carguesColombia as $Cargue)
                <tr>
                    <td>{{$Cargue->nombre}}</td>
                    <td>{{$Cargue->Grupo}}</td>
                    <td>{{$Cargue->servidor}} {{$Cargue->catalogo}}</td>
                    <td>{{$Cargue->ruta}}</td>
                    <td>{{$Cargue->periodicidad}} desde las {{$Cargue->hora_ejecucion}}</td>
                    @if($Cargue->estado=="Correcto")
                        <td><span class="label label-success">Correcto</span></td>
                    @endif

                    @if($Cargue->estado=="Represado")
                        <td><span class="label label-yellow">Represado</span></td>
                    @endif

                    @if($Cargue->estado=="Detenido")
                        <td><span class="label label-warning">Detenido</span></td>
                    @endif

                    @if($Cargue->estado=="Fallando")
                        <td><span class="label label-danger">Fallando</span></td>
                    @endif

                    <td>
                        <button href="#" class="btn  btn-xs" data-toggle="modal" title="Ver más"
                                data-target="#verCargue{{$Cargue->id}}"><span class="fa fa-search"></span>
                        </button>
                        <button href="#" class="btn  btn-xs" data-toggle="modal" title="Cambiar estado"
                                           onclick="obtenerID({{$Cargue->id}})" data-target="#cambiarEstadoCargue{{$Cargue->id}}"><span class="fa fa-refresh"></span>
                        </button>
                        @if($tipoUsuario=="1" || $tipoUsuario=="2")
                            <button href="#" class="btn  btn-xs" data-toggle="modal" title="Editar"
                                    onclick="obtenerID({{$Cargue->id}})" data-target="#editarCargue{{$Cargue->id}}"><span class="fa fa-pencil"></span>
                            </button>

                            <button href="#" class="btn  btn-xs" data-toggle="modal" title="Eliminar"
                                    data-target="#eliminarCargue{{$Cargue->id}}"><span class="fa fa-trash"></span>
                            </button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div id="tablaPanama" class="panel-body table-responsive" style="margin-bottom: 30px; display: none">
        <table class="table table-striped table-bordered table-hover" id="tablaCarguesPanama" >
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Grupo</th>
                <th>Servidor Catalogo</th>
                <th>Ruta</th>
                <th>Periocidad</th>
                <th>Estado</th>
                <th>Opc.</th>
            </tr>
            </thead>
            <tbody>

            @foreach($carguesPanama as $Cargue)

                <tr>
                    <td>{{$Cargue->nombre}}</td>
                    <td>{{$Cargue->Grupo}}</td>
                    <td>{{$Cargue->servidor}} {{$Cargue->catalogo}}</td>
                    <td>{{$Cargue->ruta}}</td>
                    <td>{{$Cargue->periodicidad}} desde las {{$Cargue->hora_ejecucion}}</td>
                        @if($Cargue->estado=="Correcto")
                            <td><span class="label label-success">Correcto</span></td>
                        @endif

                        @if($Cargue->estado=="Represado")
                            <td><span class="label label-yellow">Represado</span></td>
                        @endif

                        @if($Cargue->estado=="Detenido")
                            <td><span class="label label-warning">Detenido</span></td>
                        @endif

                        @if($Cargue->estado=="Fallando")
                            <td><span class="label label-danger">Fallando</span></td>
                        @endif

                    <td>
                        <button href="#" class="btn  btn-xs" data-toggle="modal" title="Ver más"
                                data-target="#verCargue{{$Cargue->id}}"><span class="fa fa-search"></span>
                        </button>
                        <button href="#" class="btn  btn-xs" data-toggle="modal" title="Cambiar estado"
                                         onclick="obtenerID({{$Cargue->id}})" data-target="#cambiarEstadoCargue{{$Cargue->id}}"><span class="fa fa-refresh"></span>
                        </button>
                        @if($tipoUsuario=="1" || $tipoUsuario=="2")
                            <button href="#" class="btn  btn-xs" data-toggle="modal" title="Editar"
                                   onclick="obtenerID({{$Cargue->id}})" data-target="#editarCargue{{$Cargue->id}}"><span class="fa fa-pencil"></span>
                            </button>

                            <button href="#" class="btn  btn-xs" data-toggle="modal" title="Eliminar"
                                    data-target="#eliminarCargue{{$Cargue->id}}"><span class="fa fa-trash"></span>
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    @if($tipoUsuario=="1" || $tipoUsuario=="2")
        <a class="btn btn-success " style="float:right" href="{{url('RegistrarCargue')}}"> Registrar cargue</a>

        <div id="exportarColombia" class="form-group" style="width: 200px">
            <form action="{{route('downloadCarguesColombia')}}">
                <label class="control-label">Exportar a:  </label>
                <button id="excel" class="botonimagenexcel" type="submit"></button>
            </form>
        </div>

        <div id="exportarPanama" class="form-group" style="width: 200px; display: none">
            <form action="{{route('downloadCarguesPanama')}}">
                <label class="control-label">Exportar a:  </label>
                <button id="excel" class="botonimagenexcel" type="submit"></button>
            </form>
        </div>
    @endif


@else
    <legend>¡Error!</legend>

    <div id="mensajePermisos" class="alert alert-danger">
        Permisos insuficientes.
    </div>
@endif

@stop

@section('modales')
    @foreach($cargues as $Cargue)
        @include('Cargues.ViewCargue')
        @include('Cargues.UpdateCargue')
        @include('Cargues.DeleteCargue')
        @include('Cargues.ModalCambioEstado')
    @endforeach
@stop

@section('script')
    <script type="text/javascript" src="/js/Validaciones/validacionCargue.js"></script>

@stop


