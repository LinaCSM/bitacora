<div class="modal fade" id="fallaEntregableU{{$Proceso->id}}" role="dialog" style="overflow-y: auto">
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
                    <input type="hidden" class="form-control" id="procesoE{{$Proceso->id}}" name="procesoE{{$Proceso->id}}" value="{{$Proceso->id}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="col-md-12">
                        <div class="col-md-6">

                            @if($Proceso->FK_Turno!="Noche")
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="fechaEntregableFallaE">Fecha: </label>
                                    <div class="col-md-9">
                                        <input type="text" id="fechaEntregableFallaE{{$Proceso->id}}" name="fechaEntregableFallaE{{$Proceso->id}}" class="form-control" tabindex="1" disabled>
                                    </div>
                                </div>
                            @endif
                            @if($Proceso->FK_Turno=="Noche")
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="fechaEntregableFallaEN">Fecha: </label>
                                        <div class="col-md-9">
                                            <input type="text" id="fechaEntregableFallaEN{{$Proceso->id}}" name="fechaEntregableFallaEN{{$Proceso->id}}" class="form-control" tabindex="1" disabled>
                                        </div>
                                    </div>
                            @endif
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="numeroCasoE">N° caso: </label>
                                <div class="col-md-8">
                                    <input type="text" id="numeroCasoE{{$Proceso->id}}" name="numeroCasoE{{$Proceso->id}}" class="form-control input-md" tabindex="2">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="descripcionFallaE">Descripción falla: </label>
                                <div class="col-md-8">
                                    <textarea class="form-control" id="descripcionFallaE{{$Proceso->id}}" name="descripcionFallaE{{$Proceso->id}}" rows="2" cols="25" tabindex="3"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="tipoFallaE">Tipo: </label>
                                <div class="col-md-9">
                                    <select id="tipoFallaE{{$Proceso->id}}" name="tipoFallaE{{$Proceso->id}}" class="form-control" tabindex="5">
                                        <option selected="true" disabled="true">-- Seleccione tipo --</option>
                                        <option value="Endogena">Endogena</option>
                                        <option value="Exogena">Exogena</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="estadoFallaE">Estado: </label>
                                <div class="col-md-9">
                                    <select id="estadoFallaE{{$Proceso->id}}" name="estadoFallaE{{$Proceso->id}}" class="form-control" onchange="validarEstadoFallaE(this.value)" tabindex="6">
                                        <option  selected="true" disabled="true">-- Seleccione estado --</option>
                                        <option value="En espera">En espera</option>
                                        <option value="Solucionada">Solucionada</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group" id="soluFallaE{{$Proceso->id}}" style="display: none">
                                <label class="col-md-3 control-label" for="solucionFalla">Solución: </label>
                                <div class="col-md-9">
                                    <textarea class="form-control" id="solucionFallaE{{$Proceso->id}}" name="solucionFallaE{{$Proceso->id}}" rows="2" cols="25" tabindex="7"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 control-label" for="relanzarProcesoE">¿Se relanza el proceso? </label>
                                <div class="col-md-7" style="margin-top: 6px">
                                    <select id="relanzarProcesoE{{$Proceso->id}}" name="relanzarProcesoE{{$Proceso->id}}" class="form-control"  tabindex="8" style="margin-top: 10px">
                                        <option selected="true" disabled="true">-- Seleccione --</option>
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                {!! Form::close() !!}

                    </div>

            </div>
<div class="modal-footer">
    <div class="form-group" style="float: right; margin-right: 55px;margin-top: 10px;">
        <button onclick="ajaxFallaU()" id="btnFE{{$Proceso->id}}" type="button" class="btn btn-success"> Aceptar</button>
        <button onclick="salirFallaU()" type="button" class="btn btn-danger"> Cancelar</button>
    </div>
</div>

        </div>
    </div>
</div>