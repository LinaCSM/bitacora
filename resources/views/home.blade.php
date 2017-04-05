@extends('app')

@section('Titulo')
    Administrador | Getronics
@stop

@section('contenido')
    <br/>
    <br/>
   <legend>Estamos trabajando..</legend>

@stop

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $("li").removeClass("active");
            $("#inicio").addClass("active");
        });
    </script>
@stop