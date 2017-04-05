@extends('app')
<?php use App\Http\Controllers\Controller;?>

@section('Titulo')
    Registro entregables | Getronics
@stop
@section('contenido')

    <legend>Registro de entregables</legend>
    <?php $entregables= Controller::getEnumValues('entregables','tipo')?>
    {!! Form::open(['action' => ['EntregableController@store'],'class'=>'form-inline'])!!}
        <div class="col-md-12 col-md-offset-1">
            <div class="col-md-6 ">
                <div class="form-group">
                    <label class="col-md-2 control-label" for="procesoEntregable">Proceso: </label>
                    <div class="col-md-9">
                        <select id="proceso" name="proceso" class="form-control" tabindex="1" onchange="ajaxInformacionProceso(this.value)">
                            <option selected="true" disabled="true">-- Seleccione proceso --</option>
                            @foreach($procesos as $Proceso)
                                <option value="{{$Proceso->id}}">{{$Proceso->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="tipo">Tipo entregable: </label>
                    <div class="col-md-8" style="margin-top: 15px">
                        <select id="tipo" name="tipo" class="form-control" tabindex="2">
                            <option selected="true" disabled="true">-- Seleccione un tipo --</option>
                            @foreach($entregables as $Entregable)
                                <option value="{{$Entregable}}">{{$Entregable}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form:: label('ruta','Ruta:',['class' => 'col-md-2 control-label'])!!}
                    <div class="col-md-10" >
                        {!!Form::textarea ('ruta',null, ['class'=>'form-control', 'rows' =>4, 'cols'=>32,'tabindex'=>3])!!}
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-3 control-label" for="sysdate">Sysdate: </label>
                    <div class="col-md-7">
                        <input type="text" id="sysdate" name="sysdate" class="form-control input-md" tabindex="5" disabled="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="horaEntrega">Hora aprox. entrega: </label>
                    <div class="col-md-6" style="margin-top: 15px;margin-left: -20px;">
                        <input type="text" id="horaEntrega" name="horaEntrega" class="form-control input-md" tabindex="4" disabled="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="plataforma">Plataforma: </label>
                    <div class="col-md-7">
                        <input type="text" id="plataforma" name="plataforma" class="form-control input-md" tabindex="6" disabled="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="grupoPais">Grupo/País: </label>
                    <div class="col-md-7">
                        <input type="text" id="grupoPais" name="grupoPais" class="form-control input-md" tabindex="7" disabled="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="responsableP">Responsable: </label>
                    <div class="col-md-7">
                        <input type="text" id="responsableP" name="responsableP" class="form-control input-md" tabindex="8" disabled="">
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group" style="margin-top: 30px; margin-bottom: 30px; float: right; margin-right: 100px;">
            <button class="btn btn-success" type="submit"> Registrar</button>
        </div>
    {!! Form::close() !!}
@stop


@section('script')
    <script type="text/javascript" src="/js/Validaciones/validacionListEntregable.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("li").removeClass("active");
            $("#entregable").addClass("active");
        });
    </script>

@stop