<div class="modal fade" id="fallaEntregable{{$Proceso->id}}" role="dialog" style="overflow-y: auto">
    <div class="modal-content" role="dialog" id="modalTipo1">
        <div class="modal-content">
            <div class="modal-header">
                <div id="icono">
                    <i class="fa fa-close"></i>
                    <h4 class="modal-title">Registrar falla {{$Proceso->job}}</h4>
                </div>
            </div>
            <div class="modal-body">
                {!! Form::model($Proceso,['route' => ['Falla.store']])!!}

                <input type="hidden" class="form-control" id="proceso{{$Proceso->id}}" name="proceso{{$Proceso->id}}" value="{{$Proceso->id}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="col-md-12">
                        <div class="col-md-6">

                            @if($Proceso->FK_Turno!="Noche")
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="fechaEntregableFalla">Fecha: </label>
                                    <div class="col-md-9">
                                        <input type="text" id="fechaEntregableFalla{{$Proceso->id}}" name="fechaEntregableFalla{{$Proceso->id}}" class="form-control" tabindex="2" disabled>
                                    </div>
                                </div>
                            @endif
                            @if($Proceso->FK_Turno=="Noche")
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="fechaEntregableFallaN">Fecha: </label>
                                        <div class="col-md-9">
                                            <input type="text" id="fechaEntregableFallaN{{$Proceso->id}}" name="fechaEntregableFallaN{{$Proceso->id}}" class="form-control" tabindex="2" disabled>
                                        </div>
                                    </div>
                            @endif

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="numeroCaso">N° caso: </label>
                                <div class="col-md-8">
                                    <input type="text" id="numeroCaso{{$Proceso->id}}" name="numeroCaso" class="form-control input-md" tabindex="3">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="descripcionFalla">Descripción:
                                    falla: </label>
                                <div class="col-md-8">
                                    <textarea class="form-control" id="descripcionFalla{{$Proceso->id}}" name="descripcionFalla" rows="2" cols="25" tabindex="4"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="tipoFalla">Tipo: </label>
                                <div class="col-md-9">
                                    <select id="tipoFalla{{$Proceso->id}}" name="tipoFalla{{$Proceso->id}}" class="form-control" tabindex="6">
                                        <option selected="true" disabled="true">-- Seleccione tipo --</option>
                                        <option value="Endogena">Endogena</option>
                                        <option value="Exogena">Exogena</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="estadoFalla">Estado: </label>
                                <div class="col-md-9">
                                    <select id="estadoFalla{{$Proceso->id}}" name="estadoFalla{{$Proceso->id}}" class="form-control" onchange="validarEstadoFalla(this.value)" tabindex="7">
                                        <option selected="true" disabled="true">-- Seleccione estado --</option>
                                        <option value="En espera">En espera</option>
                                        <option value="Solucionada">Solucionada</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group" id="soluFalla{{$Proceso->id}}" style="display: none">
                                <label class="col-md-3 control-label" for="solucionFalla">Solución: </label>
                                <div class="col-md-9">
                                    <textarea class="form-control" id="solucionFalla{{$Proceso->id}}" name="solucionFalla{{$Proceso->id}}" rows="2" cols="25" tabindex="8"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 control-label" for="relanzarProceso">¿Se relanza el proceso? </label>
                                <div class="col-md-7" style="margin-top: 6px">
                                    <select id="relanzarProceso{{$Proceso->id}}" class="form-control"  tabindex="8" style="margin-top: 10px">
                                        <option selected="true" disabled="true">-- Seleccione --</option>
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {!! Form:: hidden ('turno', $Proceso->FK_Turno)!!}
                {!! Form::close() !!}

                    </div>

            </div>
<div class="modal-footer">
    <div class="form-group" style="float: right; margin-right: 55px;margin-top: 10px;">
        <button onclick="ajaxFalla()" id="btnF{{$Proceso->id}}" type="button" class="btn btn-success"> Aceptar</button>
        <button onclick="salirFalla()" type="button" class="btn btn-danger"> Cancelar</button>
    </div>
</div>

        </div>
    </div>
</div>