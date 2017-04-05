<div class="modal fade" id="cambiarEstadoCargue{{$Cargue->id}}" role="dialog">
    <div class="modal-content" role="dialog" id="modalTipo2">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div id="icono">
                    <i class="fa fa-refresh"></i>
                    <h4 class="modal-title">Cambiar estado cargue GPRS</h4>
                </div>
            </div>
            <div class="modal-body">
                {!! Form::model($Cargue, ['method' => 'PATCH', 'action' => ['CargueController@update', $Cargue->id], 'files' => true])!!}
                <div style="margin-right: 30px;margin-top:10px;">
                    <div class="form-group">
                        {!! Form:: label('estado','Estado:',['class' => 'col-md-4 control-label','style'=>'text-align: right;'])!!}
                        <div class="col-md-8">
                            {!!Form :: select('estado', ['Correcto'=>'Correcto', 'Represado'=>'Represado','Detenido'=>'Detenido','Fallando'=>'Fallando'], null, ['class' => 'form-control', 'tabindex'=>1,'onchange'=>'cambiarEstado(this.value)'])!!}
                        </div>
                    </div>

                    <div id="justificacionEstadoC{{$Cargue->id}}" class="form-group" style="display: none;">
                        {!! Form:: label('justificacion',"Justificación:",['class' => 'col-md-4 control-label'])!!}
                        <div class="col-md-8">
                            {!!Form::textarea ('justificacion','', ['class'=>'form-control', 'rows' =>2, 'cols'=>25,'tabindex'=>2])!!}
                        </div>
                    </div>
                </div>
                {!! Form::hidden('id',null)!!}
            </div>
            <div class="modal-footer">
                <div class="form-group" style="float: right; margin-right: 15px;margin-top: 10px;">
                    <button id="btnCambiar" type="submit" class="btn btn-success">Cambiar</button>
                    <button class="btn btn-danger" data-dismiss="modal"> Cancelar</button>
                </div>
                {!! Form::close()!!}
            </div>
        </div>
    </div>
</div>