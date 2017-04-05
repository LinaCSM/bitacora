@extends('app')
<?php $tipoUsuario=Auth::user()->FK_Tipo?>
@section('Titulo')
    Registro cargues | Getronics
@stop
@section('contenido')
@if($tipoUsuario=="1" || $tipoUsuario=="2")
    <legend>Registro de cargues</legend>
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
    {!! Form::open(['action' => ['CargueController@store'],'class'=>'form-inline','style'=>'margin-left:40px'])!!}
        <div class="col-md-12" style="margin-bottom: 50px; margin-left: 30px; margin-top: 20px" >
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form:: label('nombre','Nombre:',['class' => 'col-md-3 control-label'])!!}
                    <div class="col-md-9">
                        {!!Form::textarea ('nombre',null, ['class'=>'form-control', 'rows' =>1, 'cols'=>23,'tabindex'=>1])!!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form:: label('ruta','Ruta:',['class' => 'col-md-2 control-label'])!!}
                    <div class="col-md-10">
                        {!!Form::textarea ('ruta',null, ['class'=>'form-control', 'rows' =>2, 'cols'=>27,'tabindex'=>2])!!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form:: label('job','Job:',['class' => 'col-md-2 control-label'])!!}
                    <div class="col-md-10">
                        {!!Form::textarea ('job',null, ['class'=>'form-control', 'rows' =>1, 'cols'=>28,'tabindex'=>3])!!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form:: label('tarea','Tarea:',['class' => 'col-md-2 control-label'])!!}
                    <div class="col-md-10">
                        {!!Form::textarea ('tarea',null, ['class'=>'form-control', 'rows' =>1, 'cols'=>28,'tabindex'=>4])!!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form:: label('tipo_archivo','Tipo archivo:',['class' => 'col-md-3 control-label'])!!}
                    <div class="col-md-8"  style="margin-top: 12px;">
                        {!! Form:: text('tipo_archivo', null, ['class' => 'form-control input-md', 'tabindex'=>5])!!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form:: label('bd','Base de datos:',['class' => 'col-md-3 control-label'])!!}
                    <div class="col-md-7" style="margin-top: 12px;">
                        {!! Form:: text('bd', null, ['class' => 'form-control input-md', 'tabindex'=>8])!!}
                    </div>
                </div>

                <div class="form-group is-empty">
                    <label class="col-md-3 control-label" for="horaEjecucion">Hora ejecución: </label>
                    <div class="col-md-8" style="margin-top: 15px">
                        <input type="text" id="horaEjecucion" name="horaEjecucion" class="form-control" tabindex="7">
                    </div>
                </div>

            </div>

            <div class="col-md-6">

                <div class="form-group">
                    {!! Form:: label('periodicidad','Periodicidad:',['class' => 'col-md-4 control-label'])!!}
                    <div class="col-md-8">
                        {!!Form::textarea ('periodicidad',null, ['class'=>'form-control', 'rows' =>1, 'cols'=>20,'tabindex'=>8])!!}
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-md-4 control-label" for="plataforma">Plataforma: </label>
                    <div class="col-md-8">
                        <select id="plataforma" name="plataforma" class="form-control" tabindex="8">
                            <option selected="true" disabled="true">-- Seleccione plataforma --</option>
                            <option value="Oracle">Oracle</option>
                            <option value="Netezza">Netezza</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="tipo">Responsable: </label>
                    <div class="col-md-8">
                        <select id="tipo" name="tipo" class="form-control" tabindex="9">
                            <option selected="true" disabled="true">-- Seleccione responsable --</option>
                            @foreach($tipos as $Tipo)
                                <option value="{{$Tipo->id}}">{{$Tipo->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="paisCargue">País: </label>
                    <div class="col-md-9">
                        <select id="paisCargue" name="paisCargue" class="form-control" tabindex="10" onchange="ajaxBuscarPais(this.value)">
                            <option selected="true" disabled="true">-- Seleccione país --</option>
                            @foreach($paises as $Pais)
                                <option value="{{$Pais->id}}">{{$Pais->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="grupoCargue">Grupo: </label>
                    <div class="col-md-9">
                        <select id="grupoCargue" name="grupoCargue" class="form-control" tabindex="11">
                            <option selected="true" disabled="true">-- Seleccione grupo --</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form:: label('servidor','Servidor:',['class' => 'col-md-3 control-label'])!!}
                    <div class="col-md-9">
                        {!!Form::textarea ('servidor',null, ['class'=>'form-control', 'rows' =>1, 'cols'=>20,'tabindex'=>6])!!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form:: label('catalogo','Catálogo:',['class' => 'col-md-3 control-label'])!!}
                    <div class="col-md-9">
                        {!!Form::textarea ('catalogo',null, ['class'=>'form-control', 'rows' =>1, 'cols'=>20,'tabindex'=>7])!!}
                    </div>
                </div>

            </div>
            <div class="form-group" style="margin-top: 10px; float: right; margin-right: 60px;">
                <button type="submit" class="btn btn-success" onclick="ajaxRegistrarCargue()"> Registrar</button>
            </div>
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        {!! Form::close() !!}

@else
    <legend>¡Error!</legend>

    <div id="mensajePermisos" class="alert alert-danger">
        Permisos insuficientes.
    </div>
@endif
@stop

@section('script')
    <script type="text/javascript" src="/js/Validaciones/validacionCargue.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            $('#horaEjecucion').datetimepicker({
                format: 'LT'
            });
        });
    </script>
@stop

