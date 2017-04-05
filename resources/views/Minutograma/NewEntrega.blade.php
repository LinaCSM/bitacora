<?php use App\Http\Controllers\MinutogramaController;?>
<div class="modal fade" id="registrarEntregable{{$Proceso->id}}" role="dialog" style="overflow-y: auto">
    <div class="modal-content" role="dialog" id="modalEntregable">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div id="icono">
                    <i class="fa fa-file"></i>
                    <h4 class="modal-title">Registrar entregable de {{$Proceso->nombre}}</h4>
                </div>
            </div>

            <div class="modal-body">
             {!! Form::model($Proceso,['route' => ['Minutograma.store'],'style'=>'margin-top:10px;'])!!}
                <div class="col-md-12" style="margin-bottom: 30px;">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form:: label('nombre','Proceso:',['class' => 'col-md-3 control-label'])!!}
                            <div class="col-md-9">
                                {!!Form::textarea ('job',null, ['class'=>'form-control', 'rows' =>2, 'cols'=>24,'tabindex'=>1,'disabled'=>'true'])!!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="estado">Estado: </label>
                            <div class="col-md-9">
                                <select id="estado{{$Proceso->id}}" name="estado{{$Proceso->id}}" class="form-control" onchange="validarEstado(this.value)" tabindex="2">
                                    <option value="0" selected="true" disabled="true">-- Seleccione estado --</option>
                                    <option value="Exitoso">Exitoso</option>
                                    <option value="Fallido">Fallido</option>
                                    <option value="No se ejecuta">No se ejecuta</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group" id="HFinalEntregable{{$Proceso->id}}">
                            <label class="col-md-3 control-label" for="horafEntregable">Hora Final: </label>
                            <div class="col-md-7" style="margin-top: 15px;">
                                <div class="input-group date">
                                    <input type="text" class="form-control" id="horafEntregable{{$Proceso->id}}" name="horafEntre" tabindex="3">
                                </div>
                            </div>
                        </div>

                        <div class="form-group" id="EstadoJustificacion{{$Proceso->id}}" style="display: none;">
                            <label class="col-md-4 control-label" for="JustificacionEstado">Justificación estado </label>
                            <div class="col-md-8">
                                <textarea class="form-control" id="JustificacionEstado{{$Proceso->id}}" name="JustificacionEstado{{$Proceso->id}}" rows="2" tabindex="8"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form:: label('tipoEntregable','Entregable:',['class' => 'col-md-4 control-label'])!!}
                            <div class="col-md-8">
                                {!!Form::text ('tipoEntregable',null, ['class'=>'form-control input-md','disabled','tabindex'=>5])!!}
                            </div>
                        </div>

                        @if($Proceso->FK_Turno!="Noche")
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="fEntregable">Fecha: </label>
                            <div class="col-md-8">
                                <input type="text" id="fEntregable{{$Proceso->id}}" name="fEntregable{{$Proceso->id}}" class="form-control" tabindex="6" disabled="true">
                            </div>
                        </div>
                        @endif
                        @if($Proceso->FK_Turno=="Noche")
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="fEntregableNoche">Fecha: </label>
                            <div class="col-md-8">
                                <input type="text" id="fEntregableNoche{{$Proceso->id}}" name="fEntregableNoche{{$Proceso->id}}" class="form-control" tabindex="6" disabled="true">
                            </div>
                        </div>
                        @endif
                        <div class="form-group">
                            {!! Form:: label('horario','Hora ejecución:',['class' => 'col-md-4 control-label'])!!}
                            <div class="col-md-8" style="margin-top: 15px;">
                                {!!Form::text ('horario',null, ['class'=>'form-control input-md','disabled','tabindex'=>7])!!}
                            </div>
                        </div>

                        <input type="hidden" id="proceso{{$Proceso->id}}" value="{{$Proceso->id}}">
                        <input type="hidden" id="asignacion{{$Proceso->id}}" value="{{$Proceso->FK_Asignacion}}">
                        <input type="hidden" id="turno{{$Proceso->id}}" value="{{$Proceso->FK_Turno}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    </div>


                </div>

                <div class="form-group" style="margin-right: 10px;">
                    <button class="btn btn-danger"  style="float: right" data-dismiss="modal"  id="btnCancelar">Cancelar</button>
                    <button onclick="ajaxStore()" class="btn btn-success" style="float: right;margin-right: 10px;margin-bottom: 10px;"> Registrar</button>
                </div>
                {!! Form::close() !!}
            </div>


        </div>
    </div>
</div>