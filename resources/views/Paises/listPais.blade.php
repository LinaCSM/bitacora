@extends('app')
<?php $tipoUsuario=Auth::user()->FK_Tipo?>
@section('Titulo')
    Paises | Getronics
@stop
@section('contenido')
    <legend>Paises</legend>

    <div class="panel-body table-responsive" style="margin-bottom: 30px;">
        <table class="table table-striped table-bordered table-hover table-responsive" id="tablaPaises">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Estado</th>
                @if($tipoUsuario=="1" || $tipoUsuario=="2")
                    <th>Opciones</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($Pais as $pais)
                <tr>
                    <td>{{$pais->nombre}}</td>
                    @if($pais->estado=="Activo")
                        <td><span class="label label-success">Activo</span></td>
                    @endif
                    @if($pais->estado=="Inactivo")
                        <td><span class="label label-danger">Inactivo</span></td>
                    @endif

                    @if($tipoUsuario=="1" || $tipoUsuario=="2")
                        <td>
                            @if($pais->estado=="Inactivo")
                                <button href="#" class="btn  btn-xs" data-toggle="modal" title="Ver más" data-target="#verPais{{$pais -> id}}">
                                    <span class="fa fa-search"></span>
                                </button>
                            @endif
                            <button href="#" class="btn  btn-xs" data-toggle="modal" title="Editar" data-target="#editarPais{{$pais->id}}"
                            onclick="obtenerID({{$pais->id}})">
                                <span class="fa fa-pencil"></span>
                            </button>
                            @if($tipoUsuario=="1" )
                                <button href="#" class="btn  btn-xs" data-toggle="modal" title="Eliminar"
                                        data-target="#eliminarPais{{$pais->id}}"><span class="fa fa-trash"></span>
                                </button>
                            @endif
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        @if($tipoUsuario=="1" || $tipoUsuario=="2")
            <button href="#" class="btn btn-success" style=" margin-top: 20px; float: right" data-toggle="modal" title="Registrar"
                data-target="#registrarPais">Registrar país </button>
        @endif
    </div>

@stop

@section('modales')
    @foreach($Pais as $paises)
        @include('Paises.UpdatePais');
        @include('Paises.DeletePais');
        @include('Paises.NewPais');
        @include('Paises.ViewPais')
    @endforeach
@stop

@section('script')
    <script type="text/javascript" src="/js/Validaciones/validarPais.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#tablaPaises').DataTable();
            $("li").removeClass("active");
            $("#general").addClass("active");
        });

    </script>
@stop