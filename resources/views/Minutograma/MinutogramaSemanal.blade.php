@extends('app')
<?php use App\Http\Controllers\MinutogramaController;?>
<?php use App\Http\Controllers\ProcesoSLAController;?>

@section('Titulo')
    Minutograma semanal | Getronics
@stop
@section('contenido')

    <legend>Entregables semanales <script>
            var date= new Date();
            var d= date.getDate();
            var day = (d<10) ? '0' + d:d;
            var m= date.getMonth()+1;
            var month= (m<10) ? '0' + m:m;
            var year = date.getFullYear();
            document.write(day+"/"+month+"/"+year);
        </script></legend>

    <div id="tablaMensuales" class="panel-body table-responsive" style="margin-bottom: 30px">
        <table class="table table-striped table-bordered table-hover table-responsive" id="tablaEntregablesSemanales">
            <thead>
            <tr>
                <th>Grupo País</th>
                <th>Job</th>
                <th>Plataforma</th>
                <th>Hora ejecucion</th>
                <th>Servidor / Catálogo</th>
                <th>Entregable</th>
                <th>Estado</th>
                <th>Opc.</th>
            </tr>
            </thead>
            <tbody>
            @foreach($procesosSemanales as $Proceso)
                <?php $busquedaEntregables = MinutogramaController::buscarEntregables($Proceso->id)?>
                <?php $busquedaEntregas = MinutogramaController::buscarEntregasSemanales($Proceso->id)?>
                @if($Proceso->semaforo=='Si')
                    <?php $generarSLA = ProcesoSLAController::calcularSLA($Proceso->id)?>
                @endif
                <tr>

                    <td>{{$Proceso->FK_Grupo}} {{$Proceso->FK_Pais}} </td>
                    <td>{{$Proceso->job}}</td>
                    <td>{{$Proceso->plataforma}}</td>
                    <td>{{$Proceso->horario}}</td>
                    <td>{{$Proceso->servidor}}-{{$Proceso->catalogo}}</td>
                    <td>
                        @foreach($busquedaEntregables as $entregables)
                            {{$entregables->Tipo}}<br>
                        @endforeach
                    </td>
                    @if($busquedaEntregas=='[]')
                        <td><span class="label label-info">Pendiente</span><br><br>
                        </td>

                        <td>
                            <button href="#" class="btn  btn-xs" data-toggle="modal" title="Ver más"
                                    data-target="#verEntregableM{{$Proceso -> id}}">
                                <span class="fa fa-search"></span>
                            </button>
                            <button href="#" class="btn  btn-xs" data-toggle="modal" title="Ver más"
                                    data-backdrop="static" data-target="#cambiarEnEjecucion{{$Proceso -> id}}">
                                <span class="fa fa-play"></span>
                            </button>
                            <button onclick="obtenerID('{{$Proceso->id}}')" class="btn  btn-xs" data-toggle="modal"
                                    title="Registrar entregable" data-backdrop="static" data-target="#registrarEntregable{{$Proceso-> id}}">
                                <span class="fa fa-file"></span>
                            </button>
                        </td>
                    @else
                        @foreach($busquedaEntregas as $entrega)
                            @if($entrega->Estado=="Exitoso")
                                <td><span class="label label-success">Exitoso</span><br><br>
                                    Hora final {{$entrega->HoraFin}}
                                </td>
                                <td>
                                    <button href="#" class="btn  btn-xs" data-toggle="modal" title="Ver más"
                                            data-target="#verEntregableE{{$Proceso -> id}}">
                                        <span class="fa fa-search"></span>
                                    </button>
                                </td>
                            @endif
                            @if($entrega->Estado=="En ejecucion")
                                <td><span class="label label-yellow">En ejecución</span><br><br>
                                </td>

                                <td>
                                    <button href="#" class="btn  btn-xs" data-toggle="modal" title="Ver más"
                                            data-target="#verEntregableM{{$Proceso -> id}}">
                                        <span class="fa fa-search"></span>
                                    </button>
                                    <button onclick="obtenerID('{{$Proceso->id}}')" href="#" class="btn  btn-xs"
                                            data-toggle="modal" data-backdrop="static" title="Registrar entregable"
                                            data-target="#updateEntregable{{$entrega-> id}}">
                                        <span class="fa fa-file"></span>
                                    </button>

                                    <input type="hidden" id="e{{$Proceso->id}}" value="{{$entrega->id}}" >

                                </td>
                            @endif
                            @if($entrega->Estado=="No se ejecuta")
                                <td><span class="label label-warning">No se ejecuta</span><br><br>
                                </td>
                                <td>
                                    <button href="#" class="btn  btn-xs" data-toggle="modal" title="Ver más"
                                            data-target="#verEntregableE{{$Proceso -> id}}">
                                        <span class="fa fa-search"></span>
                                    </button>
                                </td>
                            @endif
                            @if($entrega->Estado=="Fallido")
                                <td><span class="label label-danger">Fallido</span><br><br>
                                    Hora final {{$entrega->HoraFin}}
                                </td>
                                <td>
                                    <button href="#" class="btn  btn-xs" data-toggle="modal" title="Ver más"
                                            data-target="#verEntregableE{{$Proceso -> id}}">
                                        <span class="fa fa-search"></span>
                                    </button>
                                    <button href="#" class="btn  btn-xs" data-toggle="modal" title="Ver falla"
                                            data-target="#verFallaEntregable{{$Proceso -> id}}">
                                        <span class="fa fa-exclamation-circle"></span>
                                    </button>
                                </td>
                            @endif
                        @endforeach
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop

@section('modales')
    @foreach($procesos as $Proceso)
        @include('Minutograma.ViewProcesoMinutograma')
        @include('Minutograma.ViewProcesoEntregado')
        @include('Minutograma.ModalEnEjecucion')
        @include('Minutograma.NewEntrega')
        @include('Minutograma.ModalFallaEntregable')
        @include('Minutograma.ModalFallaEntregaU')
        @include('Minutograma.ViewFallaE')
    @endforeach

    @foreach($entregas as $Entregas)
        @include('Minutograma.EntregaUpdate')
    @endforeach

@stop
@section('script')
    <script type="text/javascript" src="/js/Validaciones/validacionMinutograma.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("li").removeClass("active");
            $("#minutograma").addClass("active");
        });
    </script>
@stop
