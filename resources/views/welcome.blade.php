<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Getronics</title>
    <!-- Fonts -->
    <!-- Styles -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">

    <!--Scripts-->
    <script src="js/jquery-1.12.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</head>

<header>

    <div id="derecha"></div>
    <div id="izquierda"></div>
    <div id="logo"></div>
    <div id="titulo">SISTEMA PARA EL CONTROL DE PROCESOS</div>

</header>
<div id="headerLine"></div>

<body>


<!--Contenido-->
<div  class="container">
    <div class="row">
        <div class="box">
            <div  class="col-md-12">
                <div class="col-md-7">
                    <img class="img-responsive" src="images/imgInicio.jpg" alt="">
                </div>
                <div class="col-md-5">
                    @if(Session::has('logout'))
                        <div id="msjLogout" class="alert alert-success">
                            {{ Session::get('logout') }}
                        </div>
                    @endif
                    <div class="col-sm-12 col-sm-offset-1 ">
                        <div id="panelInicioSesion" class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title" >INICIAR SESIÓN</h3>
                            </div>
                            <div class="panel-body" style="height: auto">
                                @include('auth/login')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

<script type="text/javascript">
    $(document).ready(function() {
        $('#msjLogout').fadeOut(3000);

    });


</script>
</html>
