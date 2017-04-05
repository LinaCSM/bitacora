@extends('app')
<?php use App\Http\Controllers\MinutogramaController;
use App\Http\Controllers\SLAController;?>

<?php $tipoUsuario=Auth::user()->FK_Tipo?>
@section('Titulo')
    Semáforo | Getronics
@stop
@section('contenido')

    <legend>Semaforo
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
    @if($tipoUsuario=="1" || $tipoUsuario=="2" || $tipoUsuario=="7")
    <button class="btn btn-info" id="btnFiltro">Filtrar <span class="fa fa-filter"></span> </button>
    <button class="btn btn-info" id="btnTodos" style="display: none">Todos</button>

    <div id="filtros" style="display: none;">
        <h6>Filtrar por:</h6>
    </div>

    <div id="formularioFiltros" style="margin-top: -6px; display: none;">
        <form class="form-inline">
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
                    <select id="searchSla" name="searchSla" class="form-control">
                        <option selected="true" disabled="true">-- SLA --</option>
                        <option>0</option>
                        <option>10</option>
                        <option>25</option>
                        <option>50</option>
                        <option>75</option>
                        <option>100</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <select id="searchEstado" name="searchEstado" class="form-control">
                        <option selected="true" disabled="true">-- Estado --</option>
                        <option>Exitoso</option>
                        <option>Fallido</option>
                        <option>No se ejecuta</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <select id="searchEstado" name="searchEstado" class="form-control">
                        <option selected="true" disabled="true">-- Turno --</option>
                        <option>Exitoso</option>
                        <option>Fallido</option>
                        <option>No se ejecuta</option>
                    </select>
                </div>
            </div>
            <button id="btnSearch" class="btn btn-xs btn-success"><span class="fa fa-search"></span></button>
        </form>
    </div>
    @endif
    <div id="tablaEntregados" class="panel-body table-responsive" style="margin-bottom: 10px">
        <table class="table table-striped table-bordered table-hover table-responsive" id="tablaSemaforo">
            <thead>
            <tr>
                <th>Proceso</th>
                <th>Frecuencia</th>
                <th>Turno</th>
                <th>Hora final</th>
                <th>SLA</th>
                <th>Estado</th>
                <th>Responsable</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody>

            @foreach($procesosSemaforo as $PSemaforo)
                <tr>
                    <td>{{$PSemaforo->job}}</td>
                    <td>{{$PSemaforo->FK_Frecuencia}}</td>
                    <td>{{$PSemaforo->FK_Turno}}</td>
                    @if($PSemaforo->FK_Turno=="Noche")
                        <?php $entregas=MinutogramaController::buscarEntregaSemaforoNoche($PSemaforo->id)?>
                    @endif
                    @if($PSemaforo->FK_Turno!="Noche")
                        <?php $entregas=MinutogramaController::buscarEntregaSemaforo($PSemaforo->id)?>
                    @endif
                    <?php $sla=SLAController::buscarSLA($PSemaforo->id)?>
                    @if($entregas=='[]')
                        <td>--:--:--</td>
                    @else
                        @foreach($entregas as $entregaP)
                            <td>{{$entregaP->HoraFin}}</td>
                        @endforeach
                    @endif
                    @if($sla=='[]')
                        <td>--</td>
                    @else
                        @foreach($sla as $SLA)
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

                        @endforeach
                    @endif
                    @if($entregas=='[]')
                        <td><span class="label label-info">Pendiente</span></td>
                    @else
                        @foreach($entregas as $entregaP)
                            @if($entregaP->estado=="Exitoso")
                                <td><span class="label label-success">Exitoso</span></td>
                            @endif
                            @if($entregaP->estado=="No se ejecuta")
                                <td><span class="label label-warning">No se ejecuta</span><br><br></td>
                            @endif
                            @if($entregaP->estado=="Fallido")
                                <td><span class="label label-danger">Fallido</span></td>
                            @endif

                        @endforeach
                    @endif
                    <td>{{$PSemaforo->FK_Tipo}}</td>
                    <td>
                        <button href="#" class="btn  btn-xs" data-toggle="modal" title="Ver más"
                                data-target="#verSemaforoP{{$PSemaforo->id}}">
                            <span class="fa fa-search"></span>
                        </button>
                        @if($tipoUsuario=="3" || $tipoUsuario=="4" || $tipoUsuario=="5" || $tipoUsuario=="6")
                        @foreach($sla as $SLA)
                            @if($SLA->porcentaje<="75" && $SLA->justificacion_SLA=="")
                                    <button href="#" class="btn  btn-xs" data-toggle="modal" title="Ver falla"
                                            data-target="#justificarSLA{{$PSemaforo -> id}}">
                                        <span class="fa fa-edit"></span>
                                    </button>
                            @endif
                        @endforeach
                            @endif

                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@stop

@section('modales')
    @foreach($procesosSemaforo as $Proceso)
        @include('Semaforo/ModalJustificarSLA');
        @include('Semaforo/ViewPSemaforo');
    @endforeach
@stop


@section('script')
    <script type="text/javascript" src="/js/Validaciones/validacionListEntregable.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#tablaSemaforo').DataTable( {
                "order": [[ 3, "desc" ]]
            } );
            $("li").removeClass("active");
            $("#semaforo").addClass("active");
        });
    </script>
@stop
