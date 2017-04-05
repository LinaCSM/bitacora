<!DOCTYPE html>
<html lang="en">
<?php $tipoUsuario=Auth::user()->FK_Tipo?>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>@yield('Titulo')</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/Table/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/Table/dataTables.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap-datetimepicker.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/css/estilos.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/css/jquery-ui.css') }}" />

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    @yield('script2')

</head>

<body>

<div id="content" class="wrapper">
    <div class="sidebar" data-color="blue" data-image= "/images/fondoMenu.jpg">
        <div class="logo">
            <img class="img-responsive" src="/images/logo_getronics.png" style="padding-bottom: 5px;width: 160px;margin-left: 35px;">
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li id="inicio">
                    <a href="{{ url('/home') }}">
                        <i class="fa fa-home"></i>
                        <p>Inicio</p>
                    </a>
                </li>
                @if($tipoUsuario=="1" || $tipoUsuario=="2" || $tipoUsuario=="3" ||$tipoUsuario=="4" ||$tipoUsuario=="5"||$tipoUsuario=="6" || $tipoUsuario=="7")
                    <li id="proceso">
                        <a href="#" class="is-dropdown-menu">
                            <i class="fa fa-tasks"></i> <p>Procesos</p>
                        </a>
                        <ul style="display: none;">

                            <li><a href="{{ url('ProcesosDiarios') }}">Diarios</a></li>
                            <li><a href="{{ url('ProcesosSemanales') }}">Semanales</a></li>
                            <li><a href="{{ url('ProcesosMensuales') }}">Mensuales</a></li>
                            <li><a href="{{ url('ProcesosPorDemanda') }}">Por demanda</a></li>
                        </ul>
                    </li>
                @endif

                @if( $tipoUsuario=="3" ||$tipoUsuario=="4" ||$tipoUsuario=="5"||$tipoUsuario=="6")
                    <li id="minutograma">
                        <a href="#" class="is-dropdown-menu">
                            <i class="fa fa-clock-o"></i> <p>Minutograma</p>
                        </a>
                        <ul style="display: none;">
                            @if( $tipoUsuario=="3" ||$tipoUsuario=="4")
                                <li><a href="{{ url('MinutogramaDiario') }}">Diario</a></li>
                            @endif
                            @if($tipoUsuario=="5"||$tipoUsuario=="6")
                                <li><a href="{{ url('MinutogramaOficina') }}">Diario</a></li>
                            @endif

                            <li><a href="{{ url('MinutogramaSemanal') }}">Semanal</a></li>
                            <li><a href="{{ url('MinutogramaMensual') }}">Mensual</a></li>
                            <li><a href="{{ url('MinutogramaDemanda') }}">Demanda</a></li>
                        </ul>
                    </li>
                @endif

                @if($tipoUsuario=="1" || $tipoUsuario=="2" || $tipoUsuario=="3" ||$tipoUsuario=="4" ||$tipoUsuario=="5"||$tipoUsuario=="6" || $tipoUsuario=="7")
                    <li id="semaforo">
                        <a href="{{ url('Semaforo') }}">
                            <i class="fa fa-dashboard"></i>
                            <p>Semáforo</p>
                        </a>
                    </li>

                    <li id="entregable">
                        <a href="{{ url('Entregables') }}">
                            <i class="fa fa-file-text-o"></i>
                            <p>Entregables</p>
                        </a>
                    </li>
                @endif

                @if($tipoUsuario=="7")
                    <li id="cargue">
                        <a href="{{ url('Cargues') }}">
                            <i class="fa fa-files-o"></i>
                            <p>Cargues</p>
                        </a>
                    </li>
                @endif

                @if($tipoUsuario=="1" ||$tipoUsuario=="2")
                <li id="cargue">
                    <a href="#" class="is-dropdown-menu">
                        <i class="fa fa-files-o"></i> <p>Cargues</p>
                    </a>
                    <ul style="display: none;">
                        <li><a href="{{ url('Cargues') }}">Todos</a></li>
                        <li><a href="{{ url('CarguesOperacion') }}">Operacion</a></li>
                    </ul>
                </li>
                @endif

                @if( $tipoUsuario=="3" ||$tipoUsuario=="4" ||$tipoUsuario=="5"||$tipoUsuario=="6" )
                    <li id="cargue">
                        <a href="{{ url('CarguesOperacion') }}">
                            <i class="fa fa-files-o"></i>
                            <p>Cargues</p>
                        </a>
                    </li>
                @endif

                @if($tipoUsuario=="1" || $tipoUsuario=="2" || $tipoUsuario=="3" ||$tipoUsuario=="4" ||$tipoUsuario=="5"||$tipoUsuario=="6" || $tipoUsuario=="7")
                    <li id="falla">
                        <a href="#" class="is-dropdown-menu">
                            <i class="fa fa-warning"></i> <p>Fallas</p>
                        </a>
                        <ul style="display: none;">
                            <li><a href="{{ url('FallasDiarias') }}">Diarias</a></li>
                            <li><a href="{{ url('FallasMensuales') }}">Mensuales</a></li>
                        </ul>
                    </li>
                @endif

                <li id="responsable">
                    <a href="{{ url('Responsables') }}">
                        <i class="fa fa-users"></i>
                        <p>Responsables</p>
                    </a>
                </li>

                @if($tipoUsuario=="1" || $tipoUsuario=="7" || $tipoUsuario=="2")
                    <li id="general">
                        <a href="#" class="is-dropdown-menu">
                            <i class="fa fa-asterisk"></i> <p>General</p>
                        </a>
                        <ul style="display: none;">
                            @if($tipoUsuario=="1" || $tipoUsuario=="7" || $tipoUsuario=="2")
                                <li><a href="{{ url('Turnos') }}">Turnos</a></li>
                                <li><a href="{{ url('Paises') }}">Paises</a></li>
                                <li><a href="{{ url('Grupos') }}">Grupos</a></li>
                                <li><a href="{{ url('SLAS') }}">SLA</a></li>
                            @endif

                            @if($tipoUsuario=="1" || $tipoUsuario=="2")
                                <li><a href="{{ url('Frecuencias') }}">Frecuencias</a></li>
                            @endif

                            @if($tipoUsuario=="1")
                                <li><a href="{{ url('Tipos') }}">Tipos usuarios</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
                <li id="reportes">
                    <a href="#" class="is-dropdown-menu">
                        <i class="fa fa-line-chart"></i>  <p>Reportes</p>
                    </a>
                    <ul style="display: none;">
                        <li><a href="{{ url('ProcesosEntregadosDiarios') }}">Diario</a></li>
                        <li><a href="{{ url('ProcesosEntregadosGeneral') }}">General</a></li>
                    </ul>
                </li>

            </ul>


        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-inverse navbar-absolute">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;<strong>{{Auth::user()->name}}</strong>
                            </a>
                            <ul class="dropdown-menu">
                            @if (Auth::guest())
                                <li><a href="{{ url('welcome') }}">Login</a></li>
                            @else
                                <li><a href="{{ url('logout') }}"> <i class="fa fa-sign-out"></i>&nbsp;Cerrar sesión</a></li>
                             @endif
                            </ul>
                        </li>

                    </ul>

                </div>
            </div>
        </nav>

        <div class="content">
            <div class="container-fluid">
                <div id="contenido" class="col-lg-12">
                    <div class="row ">
                        @yield('contenido')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @yield('modales')
</div>

</body>

<!--   Core JS Files   -->
<script src="/js/Table/jquery-1.12.4.js"></script>
<script src="/js/Table/jquery.dataTables.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/jquery-ui.js"></script>
<script src="/js/moment.js" type="text/javascript"></script>
<script src="/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="/js/application.js" type="text/javascript"></script>
<script src="/js/material.min.js" type="text/javascript"></script>
<script src="/js/material-dashboard.js"></script>


    <script type="text/javascript">
            $(document).ready(function() {
                $('.button').click(function(){

                    //Añadimos la imagen de carga en el contenedor
                    $('#content').html('<div><img src="/images/loading.gif"/></div>');

                    var page = $(this).attr('data');
                    var dataString = 'page='+page;

                    $.ajax({
                        type: "GET",
                        url: "includes/archivo.php",
                        data: dataString,
                        success: function(data) {
                            //Cargamos finalmente el contenido deseado
                            $('#content').fadeIn(1000).html(data);
                        }
                    });
                });

            });


</script>


@yield('script')

</html>
