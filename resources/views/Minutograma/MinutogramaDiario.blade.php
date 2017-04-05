@extends('app')
@section('Titulo')
    Minutograma diario | Getronics
@stop
<?php use App\Http\Controllers\MinutogramaController;?>
<?php use App\Http\Controllers\FallaController;?>
<?php use App\Http\Controllers\ProcesoSLAController;?>
@section('contenido')

    <legend id="tMañana">Entregables t. mañana
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
    <legend id="tTarde" style="display: none">Entregables t. tarde
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
    <legend id="tNoche" style="display: none">Entregables t. noche
        <script>
            var date = new Date();
            var d = date.getDate() - 1;
            var day = (d < 10) ? '0' + d : d;
            var m = date.getMonth() + 1;
            var month = (m < 10) ? '0' + m : m;
            var year = date.getFullYear();
            document.write(day + "/" + month + "/" + year);
        </script>
    </legend>

    <div id="botones">
        <?php $hora = MinutogramaController::horaActual()?>
        @if($hora>='06:00:00' && $hora<="14:00:00")
            <button class="btn btn-info" id="btnNoche">Noche</button>
            <button class="btn btn-info" id="btnTarde">Tarde</button>
            <button class="btn" id="btnMañana">Mañana</button>
        @endif

        @if($hora>='14:00:00' && $hora<="22:00:00")
                <button class="btn btn-info" id="btnNoche">Noche</button>
                <button class="btn" id="btnTarde">Tarde</button>
                <button class="btn btn-info" id="btnMañana">Mañana</button>
        @endif

        @if($hora>='22:00:00' ||$hora>='00:00:00'  && $hora<="06:00:00")
                <button class="btn" id="btnNoche">Noche</button>
                <button class="btn btn-info" id="btnTarde">Tarde</button>
                <button class="btn  btn-info" id="btnMañana">Mañana</button>
         @endif
    </div>
    @if(Session::has('flash_message'))
        <div id="mensajeAlerta" class="alert alert-success">
            {{ Session::get('flash_message') }}
        </div>
    @endif
    <div id="tablaMañana" class="panel-body table-responsive" style="margin-bottom: 30px">
        <table class="table table-striped table-bordered table-hover table-responsive" id="tablaEntregablesMañana">
            <thead>
            <tr>
                <th>Grupo País</th>
                <th>Job</th>
                <th>Plataforma</th>
                <th>Hora ejecucion</th>
                <th>Servidor Catálogo</th>
                <th>Entregables</th>
                <th>Estado</th>
                <th>Opc.</th>
            </tr>
            </thead>
            <tbody>

            @foreach($procesosMañana as $ProcesoM)
                <?php $busquedaEntregables = MinutogramaController::buscarEntregables($ProcesoM->id)?>
                <?php $busquedaEntregas = MinutogramaController::buscarEntregasMañana($ProcesoM->id)?>
                @if($ProcesoM->semaforo=='Si')
                    <?php $generarSLA= ProcesoSLAController::calcularSLA($ProcesoM->id)?>
                    <?php echo $generarSLA?>
                @endif
                <?php FallaController::registroProcesoFalla($ProcesoM->id)?>

                <tr>
                    <td>{{$ProcesoM->FK_Grupo}} {{$ProcesoM->FK_Pais}} </td>
                    <td>{{$ProcesoM->job}}</td>
                    <td>{{$ProcesoM->plataforma}}</td>
                    <td>{{$ProcesoM->horario}}</td>
                    <td>{{$ProcesoM->servidor}}-{{$ProcesoM->catalogo}}</td>

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
                                    data-target="#verEntregableM{{$ProcesoM -> id}}">
                                <span class="fa fa-search"></span>
                            </button>
                            <button href="#" onclick="obtenerID('{{$ProcesoM->id}}')" class="btn  btn-xs" data-toggle="modal" title="Ver más"
                                    data-backdrop="static" data-target="#cambiarEnEjecucion{{$ProcesoM->id}}">
                                <span class="fa fa-play"></span>
                            </button>
                            <button onclick="obtenerID('{{$ProcesoM->id}}')" class="btn  btn-xs" data-toggle="modal"
                                    title="Registrar entregable" data-backdrop="static"
                                    data-target="#registrarEntregable{{$ProcesoM -> id}}">
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
                                            data-target="#verEntregableE{{$ProcesoM -> id}}">
                                        <span class="fa fa-search"></span>
                                    </button>
                                </td>
                            @endif
                            @if($entrega->Estado=="En ejecucion")
                                <td><span class="label label-yellow">En ejecución</span><br><br>
                                </td>

                                <td>
                                    <button href="#" class="btn  btn-xs" data-toggle="modal" title="Ver más"
                                            data-target="#verEntregableM{{$ProcesoM -> id}}">
                                        <span class="fa fa-search"></span>
                                    </button>
                                    <button onclick="obtenerID('{{$ProcesoM->id}}')" href="#" class="btn  btn-xs"
                                            data-toggle="modal" title="Registrar entregable" data-backdrop="static"
                                            data-target="#updateEntregable{{$entrega-> id}}">
                                        <span class="fa fa-file"></span>
                                    </button>

                                    <input type="hidden" id="e{{$ProcesoM->id}}" value="{{$entrega->id}}" >

                                </td>
                            @endif
                            @if($entrega->Estado=="No se ejecuta")
                                <td><span class="label label-warning">No se ejecuta</span><br><br>
                                </td>
                                <td>
                                    <button href="#" class="btn  btn-xs" data-toggle="modal" title="Ver más"
                                            data-target="#verEntregableE{{$ProcesoM -> id}}">
                                        <span class="fa fa-search"></span>
                                    </button>
                                </td>
                            @endif
                            @if($entrega->Estado=="Fallido")
                                <td><span class="label label-danger">Fallido</span><br><br>
                                    Hora final {{$entrega->HoraFin}}</td>
                                <td>
                                    <button href="#" class="btn  btn-xs" data-toggle="modal" title="Ver más"
                                            data-target="#verEntregableE{{$ProcesoM -> id}}">
                                        <span class="fa fa-search"></span>
                                    </button>
                                    <button href="#" class="btn  btn-xs" data-toggle="modal" title="Ver falla"
                                            data-target="#verFallaEntregable{{$ProcesoM -> id}}">
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
    <div id="tablaTarde" class="panel-body table-responsive" style="margin-bottom: 30px">
        <table class="table table-striped table-bordered table-hover table-responsive" id="tablaEntregablesTarde">
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
            @foreach($procesosTarde as $ProcesoT)
                <?php $busquedaEntregables = MinutogramaController::buscarEntregables($ProcesoT->id)?>
                <?php $busquedaEntregas = MinutogramaController::buscarEntregasTarde($ProcesoT->id)?>
                @if($ProcesoT->semaforo=='Si')
                    <?php $generarSLA= ProcesoSLAController::calcularSLA($ProcesoT->id)?>
                @endif
                 <?php FallaController::registroProcesoFalla($ProcesoT->id)?>
                <tr>
                    <td>{{$ProcesoT->FK_Grupo}} {{$ProcesoT->FK_Pais}} </td>
                    <td>{{$ProcesoT->job}}</td>
                    <td>{{$ProcesoT->plataforma}}</td>
                    <td>{{$ProcesoT->horario}}</td>
                    <td>{{$ProcesoT->servidor}}-{{$ProcesoT->catalogo}}</td>
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
                                    data-target="#verEntregableM{{$ProcesoT -> id}}">
                                <span class="fa fa-search"></span>
                            </button>
                            <button href="#" onclick="obtenerID('{{$ProcesoT->id}}')" class="btn  btn-xs" data-toggle="modal" title="Ver más"
                                    data-backdrop="static"  data-target="#cambiarEnEjecucion{{$ProcesoT->id}}">
                                <span class="fa fa-play"></span>
                            </button>
                            <button onclick="obtenerID('{{$ProcesoT->id}}')" class="btn  btn-xs" data-toggle="modal"
                                    title="Registrar entregable" data-backdrop="static" data-target="#registrarEntregable{{$ProcesoT -> id}}">
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
                                            data-target="#verEntregableE{{$ProcesoT -> id}}">
                                        <span class="fa fa-search"></span>
                                    </button>
                                </td>
                            @endif
                            @if($entrega->Estado=="En ejecucion")
                                <td><span class="label label-yellow">En ejecución</span><br><br>
                                </td>

                                <td>
                                    <button href="#" class="btn  btn-xs" data-toggle="modal" title="Ver más"
                                            data-target="#verEntregableM{{$ProcesoT -> id}}">
                                        <span class="fa fa-search"></span>
                                    </button>
                                    <button onclick="obtenerID('{{$ProcesoT->id}}')" href="#" class="btn  btn-xs"
                                            data-toggle="modal" data-backdrop="static" title="Registrar entregable"
                                            data-target="#updateEntregable{{$entrega-> id}}">
                                        <span class="fa fa-file"></span>
                                    </button>
                                    <input type="hidden" id="e{{$ProcesoT->id}}" value="{{$entrega->id}}">
                                </td>
                            @endif
                            @if($entrega->Estado=="No se ejecuta")
                                <td><span class="label label-warning">No se ejecuta</span><br><br>
                                </td>
                                <td>
                                    <button href="#" class="btn  btn-xs" data-toggle="modal" title="Ver más"
                                            data-target="#verEntregableE{{$ProcesoT -> id}}">
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
                                            data-target="#verEntregableE{{$ProcesoT -> id}}">
                                        <span class="fa fa-search"></span>
                                    </button>
                                    <button href="#" class="btn  btn-xs" data-toggle="modal" title="Ver falla"
                                            data-target="#verFallaEntregable{{$ProcesoT -> id}}">
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
    <div id="tablaNoche" class="panel-body table-responsive" style="margin-bottom: 30px">
        <table class="table table-striped table-bordered table-hover table-responsive" id="tablaEntregablesNoche">
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
            @foreach($procesosNoche as $ProcesoN)
                <?php $busquedaEntregables = MinutogramaController::buscarEntregables($ProcesoN->id)?>
                <?php $busquedaEntregas = MinutogramaController::buscarEntregasNoche($ProcesoN->id)?>
                @if($ProcesoN->semaforo=='Si')
                    <?php $generarSLA= ProcesoSLAController::calcularSLANoche($ProcesoN->id)?>
                    <?php echo $generarSLA?>

                @endif
                <?php $registrarFalla= FallaController::registroProcesoFallaNoche($ProcesoN->id)?>
                <?php echo $registrarFalla?>
                <tr>
                    <td>{{$ProcesoN->FK_Grupo}} {{$ProcesoN->FK_Pais}} </td>
                    <td>{{$ProcesoN->job}}</td>
                    <td>{{$ProcesoN->plataforma}}</td>
                    <td>{{$ProcesoN->horario}}</td>
                    <td>{{$ProcesoN->servidor}}-{{$ProcesoN->catalogo}}</td>
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
                                    data-target="#verEntregableM{{$ProcesoN->id}}">
                                <span class="fa fa-search"></span>
                            </button>
                            <button href="#" onclick="obtenerID('{{$ProcesoN->id}}')" class="btn  btn-xs" data-toggle="modal" title="Ver más"
                                    data-backdrop="static" data-target="#cambiarEnEjecucion{{$ProcesoN->id}}">
                                <span class="fa fa-play"></span>
                            </button>
                            <button onclick="obtenerID('{{$ProcesoN->id}}')" class="btn  btn-xs" data-toggle="modal"
                                    title="Registrar entregable" data-backdrop="static" data-target="#registrarEntregable{{$ProcesoN -> id}}">
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
                                            data-target="#verEntregableE{{$ProcesoN -> id}}">
                                        <span class="fa fa-search"></span>
                                    </button>
                                </td>
                            @endif
                            @if($entrega->Estado=="En ejecucion")
                                <td><span class="label label-yellow">En ejecución</span><br><br>
                                </td>

                                <td>
                                    <button href="#" class="btn  btn-xs" data-toggle="modal" title="Ver más"
                                            data-target="#verEntregableM{{$ProcesoN -> id}}">
                                        <span class="fa fa-search"></span>
                                    </button>
                                    <button onclick="obtenerID('{{$ProcesoN->id}}')" href="#" class="btn  btn-xs"
                                            data-toggle="modal" data-backdrop="static" title="Registrar entregable"
                                            data-target="#updateEntregable{{$entrega-> id}}">
                                        <span class="fa fa-file"></span>
                                    </button>


                                    <input type="hidden" id="e{{$ProcesoN->id}}" value="{{$entrega->id}}">
                                </td>
                            @endif
                            @if($entrega->Estado=="No se ejecuta")
                                <td><span class="label label-warning">No se ejecuta</span><br><br>
                                </td>
                                <td>
                                    <button href="#" class="btn  btn-xs" data-toggle="modal" title="Ver más"
                                            data-target="#verEntregableE{{$ProcesoN -> id}}">
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
                                            data-target="#verEntregableE{{$ProcesoN -> id}}">
                                        <span class="fa fa-search"></span>
                                    </button>
                                    <button href="#" class="btn  btn-xs" data-toggle="modal" title="Ver falla"
                                            data-target="#verFallaEntregable{{$ProcesoN -> id}}">
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
            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            if (h<=9)
                h="0"+h;
            if (m<=9)
                m="0"+m;
            if (s<=9)
                s="0"+s;
            hora=h + ":" + m + ":" + s;

            if(hora>='06:00:00' && hora<="13:59:59"){
                document.getElementById("btnMañana").click();

            }
            else if(hora>='14:00:00'  && hora<="21:59:59"){
                document.getElementById("btnTarde").click();
            }
            else if(hora>='22:00:00' ||hora>='00:00:00'  && hora<="05:59:59"){
                document.getElementById("btnNoche").click();
            }
        });


    </script>

@stop
