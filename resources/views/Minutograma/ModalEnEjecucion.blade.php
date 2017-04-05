<div class="modal fade" id="cambiarEnEjecucion{{$Proceso->id}}" role="dialog">

    <div class="modal-content" role="dialog" id="modalTipo2">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div id="icono">
                    <i class="fa fa-play"></i>
                    <h4 class="modal-title">En ejecución proceso {{$Proceso->job}}</h4>
                </div>
            </div>
            <div class="modal-body">
                {!! Form::model($Proceso,['action' => ['MinutogramaController@registrarEjecucion']])!!}
                    <div style="margin-left: 70px; margin-top:10px">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="estado">Fecha: </label>
                            <div class="col-md-8">
                                <input type="text" id="estadoEje{{$Proceso->id}}" name="estadoEje{{$Proceso->id}}" class="form-control" tabindex="6" disabled="true" value="En ejecucion">
                            </div>
                        </div>

                        @if($Proceso->FK_Turno!="Noche")
                            <div class="form-group" style="display: none;">
                                <label class="col-md-4 control-label" for="fechaEjecucion">Fecha: </label>
                                <div class="col-md-8">
                                    <input type="hidden" id="fechaEjecucion{{$Proceso->id}}" name="fechaEjecucion{{$Proceso->id}}" class="form-control" tabindex="6" disabled="true">
                                </div>
                            </div>
                        @endif
                        @if($Proceso->FK_Turno=="Noche")
                            <div class="form-group" style="display: none;">
                                <label class="col-md-4 control-label" for="fEjecucionNoche">Fecha: </label>
                                <div class="col-md-8">
                                    <input type="hidden" id="fEjecucionNoche{{$Proceso->id}}" name="fEjecucionNoche{{$Proceso->id}}" class="form-control" tabindex="6" disabled="true">
                                </div>
                            </div>
                        @endif
                        <div class="form-group">
                            <div class="col-md-8">
                                <input type="hidden" id="asignacion{{$Proceso->id}}" value="{{$Proceso->FK_Asignacion}}">
                                <input type="hidden" id="proceso{{$Proceso->id}}" value="{{$Proceso->id}}">
                                <input type="hidden" id="turno{{$Proceso->id}}" value="{{$Proceso->FK_Turno}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </div>
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <div class="form-group" style="margin-right: 10px;">
                    <button onclick="ajaxEjecucion()" class="btn btn-success"> Aceptar</button>
                    <button type="button" data-dismiss="modal" class="btn btn-danger"> Cancelar</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>