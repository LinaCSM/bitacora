<?php use App\Http\Controllers\Controller;?>
<div class="modal fade" id="cambiarEstadoResponsable{{$responsable->id}}" role="dialog">
    <div class="modal-content" role="dialog" id="modalTipo2">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div id="icono">
                    <i class="fa fa-refresh"></i>
                    <h4 class="modal-title">Cambiar estado responsable<br>{{$responsable->name}} {{$responsable->lastname}}</h4>
                </div>
            </div>
            <?php $estados= Controller::getEnumValues('users','state')?>
            <div class="modal-body">
                {!! Form::model($responsable, ['method' => 'PATCH', 'action' => ['UsuarioController@update', $responsable->id], 'files' => true])!!}
                    <div style="margin-left: 30px; margin-top:10px">
                        <div class="form-group">
                            {!! Form:: label('state','Estado:',['class' => 'col-md-4 control-label'])!!}
                            <div class="col-md-8">
                                {!!Form :: select('state',$estados, null, ['class' => 'form-control', 'tabindex'=>1,'onchange'=>'cambiarEstado(this.value)'])!!}
                            </div>
                        </div>

                        <div id="justificacionEstado{{$responsable->id}}" class="form-group" style="display: none;">
                            {!! Form:: label('justificacion',"Justificación:",['class' => 'col-md-4 control-label'])!!}
                            <div class="col-md-8">
                                {!!Form::textarea ('justificacion','', ['class'=>'form-control', 'rows' =>2, 'cols'=>25,'tabindex'=>2])!!}
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="form-group" style="float: right; margin-right: 15px;margin-top: 10px;">
                    <button id="btnCambiar" type="submit" class="btn btn-success">Cambiar</button>
                    <button class="btn btn-danger" data-dismiss="modal"> Cancelar</button>
                </div>
            </div>

            {!! Form::hidden('id',null)!!}
            {!! Form::close()!!}
        </div>
    </div>
</div>