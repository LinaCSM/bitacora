<div class="modal fade" id="cambiarResponsable{{$Proceso -> id}}" role="dialog">
    <div class="modal-content" role="dialog" id="modalTipo2">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div id="icono">
                    <i class="fa fa-user-plus"></i>
                    <h4 class="modal-title">Cambiar responsable de proceso {{$Proceso -> nombre}}</h4>
                </div>
            </div>
            <div class="modal-body">
                {!! Form::model($Proceso,['action' => ['ProcesoController@actualizarResponsable'],'class'=>'form-inline','style'=>'margin-left:70px;'])!!}
                <div style="margin-left: 10px; margin-top:10px; margin-right:10px">
                    <div class="form-group">
                        {!! Form:: label('FK_Tipo','Responsable:',['class' => 'col-md-5 control-label'])!!}
                        <div class="col-md-7">
                            {!!Form :: select('FK_Tipo', $responsable,  null, ['class' => 'form-control', 'tabindex'=>17,'id'=>"tipo{$Proceso->id}"])!!}
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