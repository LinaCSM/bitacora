<div class="modal fade" id="cambiarEstadoProceso{{$Proceso -> id}}" role="dialog">
    <div class="modal-content" role="dialog" id="modalTipo2">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div id="icono">
                    <i class="fa fa-refresh"></i>
                    <h4 class="modal-title">Cambiar estado proceso {{$Proceso -> nombre}}</h4>
                </div>
            </div>

            <div class="modal-body">
                {!! Form::model($Proceso, ['method' => 'PATCH', 'action' => ['ProcesoController@update', $Proceso->id], 'files' => true])!!}
                    <div style="margin-left: 10px; margin-top:10px; margin-right:10px">
                        <div class="form-group">
                            {!! Form:: label('estado','Estado:',['class' => 'col-md-4 control-label','style'=>'text-align: right;'])!!}
                            <div class="col-md-8">
                                {!!Form :: select('estado', ['Activo'=>'Activo', 'Inactivo'=>'Inactivo','Bloqueado'=>'Bloqueado'], null, ['class' => 'form-control', 'tabindex'=>1,'onchange'=>'validarCambioEstadoProceso(this.value)'])!!}
                            </div>
                        </div>

                    <div id="justificacionEstado{{$Proceso->id}}" class="form-group" style="display: none;">
                        {!! Form:: label('justificacion',"Justificación:",['class' => 'col-md-4 control-label'])!!}
                        <div class="col-md-8">
                            {!!Form::textarea ('justificacion','', ['class'=>'form-control', 'rows' =>2, 'cols'=>25,'tabindex'=>2])!!}
                        </div>
                    </div>

                    </div>
                    <div>
                        <label class="control-label" id="informacionEstado{{$Proceso->id}}"  style="text-align: center; font-size: 16px; display: none; "><span class="fa fa-exclamation-triangle"></span> Recuerde que al inactivar el proceso también inactivara todos los entregables asociados a este.</label>
                        <label class="control-label" id="informacionEstadoB{{$Proceso->id}}"  style="text-align: center; font-size: 16px; display: none;"><span class="fa fa-exclamation-triangle"></span> Recuerde que al bloquear el proceso también bloqueara todos los entregables asociados a este.</label>
                    </div>
                     {!! Form::hidden('id',null)!!}

            </div>

            <div class="modal-footer">
                <div class="form-group" style="float: right; margin-right: 15px;margin-top: 10px;">
                    <button id="btnCambiar" type="submit" class="btn btn-success">Cambiar</button>
                    <button class="btn btn-danger" data-dismiss="modal"> Cancelar</button>
                </div>
            </div>
            {!! Form::close()!!}
        </div>
    </div>
</div>