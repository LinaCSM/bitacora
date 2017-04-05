<?php use App\Http\Controllers\MinutogramaController; ?>
<?php use App\Http\Controllers\FallaController;?>
<div class="modal fade" id="updateEntregable{{$Entregas->id}}" role="dialog" style="overflow-y: auto">
    <div class="modal-content" role="dialog" id="modalEntregable">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div id="icono">
                    <i class="fa fa-file"></i>
                    <h4 class="modal-title">Registrar entregable de {{$Entregas->PNombre}}</h4>
                </div>
            </div>

            <div class="modal-body">
                {!! Form::model($Entregas,['action' => ['MinutogramaController@editEntrega'],'style'=>'margin-top:10px;'])!!}
                    <div class="col-md-12" style="margin-bottom: 30px">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="nombre">Proceso: </label>
                                <div class="col-md-9">
                                    <textarea class="form-control" id="nombre" name="nombre" rows="2" cols="24" tabindex="1" disabled>{{$Entregas->PJob}}</textarea>
                                </div>
                            </div>

                            <div class="form-group is-empty">
                                <label class="col-md-3 control-label" for="estadoE">Estado: </label>
                                <div class="col-md-9">
                                    <select id="estadoE{{$Entregas->Pid}}" name="estadoE{{$Entregas->Pid}}"
                                            class="form-control"
                                            onchange="validarEstadoUpdate(this.value)" tabindex="2">
                                        <option value="0" selected="true" disabled="true">-- Seleccione estado --</option>
                                        <option value="Exitoso">Exitoso</option>
                                        <option value="Fallido">Fallido</option>
                                        <option value="No se ejecuta">No se ejecuta</option>
                                    </select>

                                </div>
                            </div>

                            <div class="form-group" id="HFinalEntregableE{{$Entregas->id}}">
                                <label class="col-md-3 control-label" for="horafEntregableE">Hora Final: </label>
                                <div class="col-md-7" style="margin-top: 15px;">
                                    <div class="input-group date">
                                        <input type="text" class="form-control" id="horafEntregableE{{$Entregas->id}}" value="24:24:00"
                                               name="horafEntregableE"  tabindex="3">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" id="EstadoJustificacionE{{$Entregas->id}}" style="display: none;">
                                <label class="col-md-4 control-label" for="justificacionEstado">Justificación
                                    estado </label>
                                <div class="col-md-8">
                                    <textarea class="form-control" id="justificacionEstado{{$Entregas->Pid}}"
                                              name="justificacionEstado{{$Entregas->Pid}}" rows="2"
                                              tabindex="8"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="tipoEntregable">Entregable: </label>
                                <div class="col-md-8">
                                    <input type="text" id="tipoEntregable" name="tipoEntregable" value="{{$Entregas->PEntregable}}" class="form-control input-md" tabindex="5" disabled="true">
                                </div>
                            </div>

                            @if($Entregas->PTurno!="Noche")
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="fEntregableE">Fecha: </label>
                                    <div class="col-md-8">
                                        <input type="text" id="fEntregableE{{$Entregas->Pid}}"
                                               name="fEntregableE{{$Entregas->Pid}}" class="form-control" tabindex="6"
                                               disabled="true" value="{{$Entregas->fecha}}">
                                    </div>
                                </div>
                            @endif
                            @if($Entregas->PTurno=="Noche")
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="fEntregableNocheE">Fecha: </label>
                                    <div class="col-md-8">
                                        <input type="text" id="fEntregableNocheE{{$Entregas->Pid}}" name="fEntregableNocheE{{$Entregas->Pid}}" class="form-control" tabindex="6" disabled="true">
                                    </div>
                                </div>
                            @endif

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="horario">Hora ejecución: </label>
                                <div class="col-md-8" style="margin-top: 15px;">
                                    <input type="text" class="form-control" id="horario" name="horario"
                                           value="{{$Entregas->PHorario}}" tabindex="7" disabled="true">
                                </div>
                            </div>
                            <input type="hidden" class="form-control" id="entrega{{$Entregas->Pid}}"
                                   name="entrega{{$Entregas->Pid}}" value="{{$Entregas->id}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" id="turnoE{{$Entregas->Pid}}" value="{{$Entregas->PTurno}}">
                        </div>
                    </div>
                    <div class="form-group" style="margin-right: 10px;">
                        <button class="btn btn-danger"  style="float: right" data-dismiss="modal"  id="btnCancelar">Cancelar</button>
                        <button onclick="ajaxUp()" class="btn btn-success" style="float: right;margin-right: 10px;margin-bottom: 10px;"> Registrar</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

