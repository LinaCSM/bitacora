@extends('app')
<?php use \App\Http\Controllers\Controller;?>
@section('Titulo')
    Registro proceso | Getronics
@stop
@section('contenido')

    <legend>Registro de procesos</legend>

    @if(Session::has('flash_message'))
        <div id="mensajeAlerta" class="alert alert-success">
            {{ Session::get('flash_message') }}
        </div>
    @endif

    @if(Session::has('error_message'))
        <div id="mensajeAlerta" class="alert alert-danger">
            {{ Session::get('error_message') }}
        </div>
    @endif


    {!! Form::open(['action' => ['ProcesoController@store'],'class'=>'form-inline editproceso-form','style'=>'margin-top:10px'])!!}


    <fieldset>
        <div style="margin-left: 100px">
            <div class="col-md-6 ">
                <div class="form-group">
                    {!! Form:: label('nombre','Nombre:',['class' => 'col-md-3 control-label'])!!}
                    <div class="col-md-9">
                        {!!Form::textarea ('nombre','', ['class'=>'form-control', 'rows' =>2, 'cols'=>24,'tabindex'=>1])!!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form:: label('job','Job:',['class' => 'col-md-3 control-label'])!!}
                    <div class="col-md-9">
                        {!!Form::textarea ('job','', ['class'=>'form-control', 'rows' =>2, 'cols'=>28,'tabindex'=>2])!!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form:: label('tarea_programada','Tarea:',['class' => 'col-md-3 control-label'])!!}
                    <div class="col-md-9">
                        {!!Form::textarea ('tarea_programada','', ['class'=>'form-control', 'rows' =>2, 'cols'=>27,'tabindex'=>3])!!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form:: label('prerequisito','Pre-requisito:',['class' => 'col-md-3 control-label'])!!}
                    <div class="col-md-9">
                        {!!Form::textarea ('prerequisito','', ['class'=>'form-control', 'rows' =>2, 'cols'=>20,'tabindex'=>4])!!}
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-3 control-label" for="pais">País: </label>
                    <div class="col-md-9">
                        <select id="pais" name="pais" class="form-control" tabindex="5" onchange="ajaxBuscarPais(this.value)">
                            <option selected="true" disabled="true">-- Seleccione país --</option>
                            @foreach($paises as $Pais)
                                <option value="{{$Pais->id}}">{{$Pais->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="grupoProceso">Grupo: </label>
                    <div class="col-md-9">
                        <select id="grupo" name="grupo" class="form-control" tabindex="6">
                            <option selected="true" disabled="true">-- Seleccione grupo --</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form:: label('sysdate','Sysdate:',['class' => 'col-md-3 control-label'])!!}
                    <div class="col-md-9">
                        {!! Form:: text('sysdate', '', ['class' => 'form-control input-md', 'tabindex'=>7])!!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form:: label('servidor','Servidor:',['class' => 'col-md-3 control-label'])!!}
                    <div class="col-md-9">
                        {!!Form::textarea ('servidor','', ['class'=>'form-control', 'rows' =>1, 'cols'=>20,'tabindex'=>8])!!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form:: label('catalogo','Catálogo:',['class' => 'col-md-3 control-label'])!!}
                    <div class="col-md-9">
                        {!!Form::textarea ('catalogo','', ['class'=>'form-control', 'rows' =>1, 'cols'=>20,'tabindex'=>9])!!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="plataforma">Plataforma: </label>
                    <div class="col-md-9">
                        <select id="plataforma" name="plataforma" class="form-control" tabindex="10">
                            <option selected="true" disabled="true">-- Seleccione plataforma --</option>
                            <option value="Oracle">Oracle</option>
                            <option value="Netezza">Netezza</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group" style="float: right; margin-right: 15px;margin-top: 10px; margin-bottom: 30px">
                <button type="button" class="btn btn-success btn-next">Siguiente</button>
            </div>
        </div>
    </fieldset>

    <fieldset class="fieldset2">
        <div style="margin-left: 100px">
            <div class="col-md-6 ">
                <div class="form-group">
                    <label class="col-md-3 control-label" for="turno">Turno: </label>
                    <div class="col-md-9">
                        <select id="turno" name="turno" class="form-control" tabindex="11">
                            <option selected="true" disabled="true">-- Seleccione turno --</option>
                            @foreach($turnos as $Turno)
                                <option value="{{$Turno->id}}">{{$Turno->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="horarioProceso">Horario: </label>
                    <div class="col-md-9">
                        <div class='input-group date'>
                            <input type='text' class="form-control" id='horarioProceso' tabindex="12"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="t_ejecucionProceso">Tiempo ejecución: </label>
                    <div class="col-md-9">
                        <div class='input-group date'>
                            <input type='text' class="form-control" id='t_ejecucionProceso'
                                   style="margin-left:-8px; margin-top: 10px;" tabindex="13"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="frecuencia">Frecuencia: </label>
                    <div class="col-md-8">
                        <select id="frecuencia" name="frecuencia" class="form-control"
                                onchange="validarFrecuencia(this.value)" tabindex="14">
                            <option value="0" selected="true" disabled="true">-- Seleccione frecuencia --</option>
                            @foreach($frecuencias as $Frecuencia)
                                <option value="{{$Frecuencia->id}}">{{$Frecuencia->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group" id="diasFrecuencia" style="display: none;">
                    <label class="col-md-3 control-label" for="diasE">Dias ejecución: </label>
                    <div class="col-md-7"style="margin-top: 12px;" >
                            <textarea class="form-control" id="diasE" name="diasE" rows="1" tabindex="15" cols="25"
                                      disabled></textarea>
                    </div>
                </div>

            </div>
            <div class="col-md-6">

                <div class="form-group">
                    <label class="col-md-4 control-label" for="tipo">Responsable: </label>
                    <div class="col-md-8">
                        <select id="tipo" name="tipo" class="form-control" tabindex="16">
                            <option selected="true" disabled="true">-- Seleccione responsable --</option>
                            @foreach($tipos as $Tipo)
                                <option value="{{$Tipo->id}}">{{$Tipo->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <?php $entregables= Controller::getEnumValues('entregables','tipo')?>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="semaforoP">¿Pertenece al semaforo? </label>
                    <div class="col-md-7" style="margin-top: 6px">
                        <select id="semaforoP" name="semaforoP" class="form-control" tabindex="17">
                            <option selected="true" disabled="true">-- Seleccione una opcion --</option>
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="tipoE">Tipo entregable: </label>
                    <div class="col-md-8" style="margin-top: 15px">
                        <select id="tipoE" name="tipoE" class="form-control" tabindex="2">
                            <option selected="true" disabled="true">-- Seleccione un tipo --</option>
                            @foreach($entregables as $Entregable)
                                <option value="{{$Entregable}}">{{$Entregable}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form:: label('ruta','Ruta entregable:',['class' => 'col-md-3 control-label'])!!}
                    <div class="col-md-8" >
                        {!!Form::textarea ('ruta',null, ['class'=>'form-control', 'rows' =>4, 'cols'=>32,'tabindex'=>3])!!}
                    </div>
                </div>

            </div>
        </div>
        <div class="form-group" style="float: right; margin-right: 15px;margin-top: 60px; margin-bottom: 30px">
            <button type="button" class="btn btn-previous">Anterior</button>
            <button type="submit" class="btn btn-success" onclick="ajaxRegistrarProceso()">Registrar</button>
        </div>
    </fieldset>


    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" id="tamano">
    {!! Form::close() !!}


@stop

@section('modales')
    @include('Procesos/ModalFrecuenciaS')
    @include('Procesos/ModalFrecuenciaM')
@stop

@section('script')
    <script type="text/javascript" src="/js/Validaciones/validacionFrecuencia.js"></script>
    <script type="text/javascript" src="/js/Validaciones/validacionProceso.js"></script>
    <script type="text/javascript">
        $(function () {
            $('#horarioProceso').datetimepicker({
                format: 'LT'
            });
        });

        $(function () {
            $('#t_ejecucionProceso').datetimepicker({
                format: 'LT'
            });
        });
    </script>
@stop