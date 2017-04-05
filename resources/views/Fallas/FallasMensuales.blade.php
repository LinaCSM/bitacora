@extends('app')
<?php use App\Http\Controllers\FallaController; ?>
<?php $tipoUsuario=Auth::user()->FK_Tipo?>

@section('Titulo')
    Fallas mensuales | Getronics
@stop
@section('contenido')
    <legend>Fallas mes
        <script>
            var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            var f=new Date();
            document.write(meses[f.getMonth()]);
        </script>
    </legend>
@if($tipoUsuario=="1" || $tipoUsuario=="2" || $tipoUsuario=="7")
    <button class="btn btn-info" id="btnFiltro">Filtrar <span class="fa fa-filter"></span></button>
    <button class="btn btn-info" id="btnTodos" style="display: none">Todos</button>

    <div id="filtros" style="display: none;">
        <h6>Filtrar por:</h6>
    </div>

    <div id="formularioFiltros" style="display: none;">
        <form class="form-inline">
            <div class="form-group">
                <div class="col-md-12">
                    <input type="text" id="searchNombreProceso" name="nombreProceso" class="form-control input-md"
                           placeholder="-- Proceso --">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <input type="text" id="searchFechaFalla" name="searchFechaFalla" class="form-control"
                           placeholder="-- Fecha --">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <input type="text" id="searchNCaso" name="searchNCaso" class="form-control input-md"
                           placeholder="-- N° Caso --">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <select id="searchResponsable" name="searchResponsable" class="form-control">
                        <option selected="true" disabled="true">-- Estado --</option>
                        <option>En espera</option>
                        <option>Solucionado</option>
                    </select>
                </div>
            </div>
            <button class="btn btn-success"><span class="fa fa-search"></span></button>
        </form>
    </div>
@endif

    <div class="panel-body table-responsive">
        <table class="table table-striped table-bordered table-hover table-responsive" id="tablaFallaMensuales">
            <thead>
            <tr>
                <th>Proceso</th>
                <th>N° caso</th>
                <th>Tipo</th>
                <th>Descripcion</th>
                <th>Estado</th>
                <th>Responsable</th>
                <th>Fecha</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($fallas as $falla)
                <tr>
                    <td>{{$falla->job}}</td>
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
                    <td>{{$falla->fecha}}</td>
                    <td>
                        <button href="#" class="btn  btn-xs" data-toggle="modal" title="Ver más"
                                data-target="#verFalla{{$falla -> id}}">
                            <span class="fa fa-search"></span>
                        </button>
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
            <form action="{{route('downloadFallasMensuales')}}">
                <label class="control-label">Exportar a:  </label>
                <button id="excel" class="botonimagenexcel" type="submit"></button>
            </form>
        </div>
    @endif
@stop

@section('modales')
    @foreach($fallas as $Falla)
        @include('Fallas.ViewFallaM')
        @include('Fallas.ModalCambioEstado')
    @endforeach
@stop

@section('script')
    <script type="text/javascript" src="/js/Validaciones/validacionFalla.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("li").removeClass("active");
            $("#falla").addClass("active");
        });
    </script>
@stop