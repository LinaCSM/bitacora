<?php use App\Http\Controllers\Controller;?>
<div class="modal fade" id="editarGrupo{{$grupos -> id}}" role="dialog">
    <div class="modal-content" role="dialog" id="modalTipo3">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div id="icono">
                    <i class="fa fa-pencil"></i>
                    <h4 class="modal-title">Editar grupo {{$grupos -> nombre}} - {{$grupos -> pais}}</h4>
                </div>
            </div>
            <?php $estado= Controller::getEnumValues('grupos','estado')?>
            <div class="modal-body">
                {!! Form::model($grupos, ['method' => 'PATCH', 'action' => ['GrupoController@update', $grupos->id], 'files' => true,'style'=>'margin-left:40px'])!!}
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form:: label('nombre',"Nombre:",['class' => 'col-md-3 control-label'])!!}
                            <div  class="col-md-8">
                                {!! Form:: text('nombre',null, ['class' => 'form-control', 'required' => 'required','tabindex'=>1])!!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form:: label('descripcion',"Descripción:",['class' => 'col-md-3 control-label'])!!}
                            <div class="col-md-8">
                                {!!Form::textarea ('descripcion',null, ['class'=>'form-control', 'rows' =>2, 'cols'=>30,'tabindex'=>2])!!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form:: label('FK_Pais','País:',['class' => 'col-md-3 control-label'])!!}
                            <div class="col-md-8">
                                {!!Form :: select('FK_Pais',$paises, null, ['class' => 'form-control', 'tabindex'=>3])!!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form:: label('estado',"Estado:",['class' => 'col-md-3 control-label'])!!}
                            <div class="col-md-8">
                                {!!Form :: select ("estado", $estado, null, ['class' => 'form-control','onchange'=>'validarCambioEstadoGrupo(this.value)','tabindex'=>4])!!}
                            </div>
                        </div>

                        <div id="justificacionEstadoGrupo{{$grupos->id}}" class="form-group" style="display: none">
                            {!! Form:: label('justificacion',"Justificación:",['class' => 'col-md-3 control-label'])!!}
                            <div class="col-md-8">
                                {!!Form::textarea ('justificacion','', ['class'=>'form-control', 'rows' =>2, 'cols'=>25,'tabindex'=>3])!!}
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="control-label" id="informacionEstadoGrupo{{$grupos->id}}" style="text-align: center; font-size: 16px; display: none; "><span class="fa fa-exclamation-triangle"></span> Recuerde que al inactivar el grupo también inactivara todos los procesos asociados a este.</label>
                    </div>
            </div>
            <div class="modal-footer">
                <div id="btnActualizar" class="form-group">
                    <button class="btn btn-success" id="btnActualizarFalla" type="submit" style="margin-right: 20px"> Actualizar</button>
                </div>
            </div>

            {!! Form::hidden('id',$grupos->id)!!}
            {!! Form::close()!!}
        </div>
    </div>
</div>