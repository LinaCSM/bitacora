@extends('app')
<?php use App\Http\Controllers\MinutogramaController;?>
<?php $tipoUsuario=Auth::user()->FK_Tipo?>

@section('Titulo')
    Fallas diarias | Getronics
@stop
@section('contenido')
    <?php $horas=MinutogramaController::horaActual()?>

    @if($horas>='00:00:00' && $horas<='21:59:59')
    <legend>Fallas
        <script>
            var date = new Date();
            var d = date.getDate();
            var day = (d < 10) ? '0' + d : d;
            var m = date.getMonth() + 1;
            var month = (m < 10) ? '0' + m : m;
            var year = date.getFullYear();
            document.write(day + "/" + month + "/" + year);
        </script>
        - Noche
        <script>
            var date = new Date();
            var d = date.getDate()- 1;
            var day = (d < 10) ? '0' + d : d;
            var m = date.getMonth() + 1;
            var month = (m < 10) ? '0' + m : m;
            var year = date.getFullYear();
            document.write(day + "/" + month + "/" + year);
        </script>

    </legend>
    @endif

    @if($horas>='22:00:00' && $horas<='23:59:59')
        <legend>Fallas
            <script>
                var date = new Date();
                var d = date.getDate();
                var day = (d < 10) ? '0' + d : d;
                var m = date.getMonth() + 1;
                var month = (m < 10) ? '0' + m : m;
                var year = date.getFullYear();
                document.write(day + "/" + month + "/" + year);
            </script>
        </legend>
    @endif
    @if(Session::has('flash_message'))
        <div id="mensajeAlerta" class="alert alert-warning">
            {{ Session::get('flash_message') }}
        </div>
    @endif

    @if(Session::has('flash_message_ok'))
        <div id="mensajeAlerta" class="alert alert-success">
            {{ Session::get('flash_message_ok') }}
        </div>
    @endif


    <div class="panel-body table-responsive">
        <table class="table table-striped table-bordered table-hover table-responsive" id="tablaFalla">
            <thead>
            <tr>
                <th>Proceso</th>
                <th>Turno</th>
                <th>N° caso</th>
                <th>Tipo</th>
                <th>Descripcion</th>
                <th>Estado</th>
                <th>Responsable</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody>
                @foreach($fallas as $falla)
                    <tr>
                        <td>{{$falla->job}}</td>
                        <td>{{$falla->FK_Turno}}</td>
                        <td>{{$falla->n_caso}}</td>
                        <td>{{$falla->tipo}}</td>
                        <td>{{$falla->descripcion}}</td>
                        @if($falla->estado=="En espera")
                            <td><span class="label label-info">En espera</span></td>
                        @endif
                        @if($falla->estado=="Solucionada")
                            <td><span class="label label-success">Solucionada</span></td>
                        @endif

                        <td>{{$falla->FK_Tipo}}</td>
                        <td>
                            <button href="#" class="btn  btn-xs" data-toggle="modal" title="Ver más"
                                    data-target="#verFalla{{$falla -> id}}">
                                <span class="fa fa-search"></span>
                            </button>
                            @if($tipoUsuario=="1" || $tipoUsuario=="2")
                                <button href="#" class="btn  btn-xs" data-toggle="modal" title="Editar"
                                        onclick="obtenerID({{$falla -> Pid}})" data-target="#editarFalla{{$falla -> id}}">
                                    <span class="fa fa-pencil"></span>
                                </button>
                                <button href="#" class="btn  btn-xs" data-toggle="modal" title="Eliminar"
                                        data-target="#eliminarFalla{{$falla -> id}}"><span class="fa fa-trash"></span>
                                </button>
                            @endif

                            @if($tipoUsuario=="1" || $tipoUsuario=="2" || $tipoUsuario=="3" || $tipoUsuario=="4" || $tipoUsuario=="5" || $tipoUsuario=="6")
                                @if($falla->estado=="En espera")
                                    <button href="#" class="btn  btn-xs" data-toggle="modal" title="Cambiar estado"
                                            onclick="obtenerIDFalla({{$falla -> id}})" data-target="#cambiarEstadoFalla{{$falla -> id}}"><span class="fa fa-refresh"></span>
                                    </button>
                                @endif
                            @endif

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($tipoUsuario=="1" || $tipoUsuario=="2" || $tipoUsuario=="7")
        <div class="form-group" style="width: 200px">
            <form action="{{route('downloadFallasDiarias')}}">
                <label class="control-label">Exportar a:  </label>
                <button id="excel" class="botonimagenexcel" type="submit"></button>
            </form>
        </div>
    @endif

@stop

@section('modales')
        @foreach($fallas as $Falla)
            @include('Fallas.ViewFalla')
            @include('Fallas.UpdateFalla')
            @include('Fallas.DeleteFalla')
            @include('Fallas.ModalCambioEstado')
        @endforeach
@stop

@section('script')
    <script type="text/javascript" src="/js/Validaciones/validacionFalla.js"></script>
    <script type="text/javascript" src="/js/Validaciones/validarInformacionEstado.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("li").removeClass("active");
            $("#falla").addClass("active");
        });
    </script>
@stop