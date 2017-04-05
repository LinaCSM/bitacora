<?php use App\Http\Controllers\Controller;?>
<div class="modal fade" id="editarTipo{{$tipo->id}}" role="dialog" style="overflow-y: auto">
    <div class="modal-content" role="dialog" id="modalTipo2">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div id="icono">
                    <i class="fa fa-pencil"></i>
                    <h4 class="modal-title">Editar tipo {{$tipo->nombre}}</h4>
                </div>
            </div>
            <?php $estado= Controller::getEnumValues('tipos','estado')?>
                <div class="modal-body">
                    {!! Form::model($tipo, ['method' => 'PATCH', 'action' => ['TipoController@update', $tipo->id], 'files' => true,'style'=>'margin-left:40px;margin-top: 10px;margin-right: 20px;'])!!}
                    <div class="col-md-12">
                            <div class="form-group">
                                {!! Form:: label('nombre',"Nombre:",['class' => 'col-md-3 control-label'])!!}
                                <div  class="col-md-8">
                                    {!! Form:: text('nombre',null, ['class' => 'form-control', 'required' => 'required','tabindex'=>1])!!}
                                </div>
                            </div>

                            <div class="form-group">
                                    {!! Form:: label('estado',"Estado:",['class' => 'col-md-3 control-label'])!!}
                                    <div class="col-md-8">
                                        {!!Form :: select ("estado", $estado, null, ['class' => 'form-control','onchange'=>'validarCambioEstadoTipo(this.value)','tabindex'=>2])!!}
                                    </div>
                            </div>

                            <div id="justificacionEstadoTipo{{$tipo->id}}" class="form-group" style="display: none">
                                {!! Form:: label('justificacion',"Justificación:",['class' => 'col-md-4 control-label'])!!}
                                <div class="col-md-8">
                                    {!!Form::textarea ('justificacion','', ['class'=>'form-control', 'rows' =>2, 'cols'=>25,'tabindex'=>3])!!}
                                </div>
                            </div>
                    </div>

                    <div>
                        <label class="control-label" id="informacionEstadoTipo{{$tipo->id}}" style="text-align: center; font-size: 16px; display: none; "><span class="fa fa-exclamation-triangle"></span> Recuerde que al inactivar el tipo también inactivara todos los procesos y usuarios asociados a este.</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <div id="btnActualizar" class="form-group">
                        <button class="btn btn-success" id="btnActualizarFalla" type="submit" style="margin-right: 10px"> Actualizar</button>
                    </div>
                </div>

            {!! Form::hidden('id',$tipo->id)!!}
            {!! Form::close()!!}
            </div>

        </div>
    </div>
</div>