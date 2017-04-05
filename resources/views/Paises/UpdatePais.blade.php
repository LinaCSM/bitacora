<?php use App\Http\Controllers\Controller;?>
<div class="modal fade"  id="editarPais{{$paises -> id}}" role="dialog" style="overflow-y: auto">
    <div class="modal-content" role="dialog"  id="modalTipo2">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div id="icono">
                    <i class="fa fa-pencil"></i>
                    <h4 class="modal-title">Editar país {{$paises -> nombre}}</h4>
                </div>
            </div>
            <?php $estado= Controller::getEnumValues('paises','estado')?>
            <div class="modal-body">
                {!! Form::model($paises, ['method' => 'PATCH', 'action' => ['PaisController@update', $paises->id], 'files' => true,'style'=>'margin-left:30px'])!!}
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form:: label('nombre',"Nombre:",['class' => 'col-md-3 control-label'])!!}
                        <div  class="col-md-8">
                            {!! Form:: text('nombre',null, ['class' => 'form-control', 'required' => 'required','id'=> 'nombrePais','tabindex'=>1])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form:: label('estado',"Estado:",['class' => 'col-md-3 control-label'])!!}
                        <div class="col-md-8">
                            {!!Form :: select ("estado", $estado, null, ['class' => 'form-control','onchange'=>'validarCambioEstadoPais(this.value)','tabindex'=>2])!!}
                        </div>
                    </div>


                    <div id="justificacionEstadoPais{{$paises->id}}" class="form-group" style="display: none;">
                        {!! Form:: label('justificacion',"Justificación:",['class' => 'col-md-4 control-label'])!!}
                        <div class="col-md-8">
                            {!!Form::textarea ('justificacion','', ['class'=>'form-control', 'rows' =>2, 'cols'=>25,'tabindex'=>3])!!}
                        </div>
                    </div>
                </div>
                <div>
                    <label class="control-label" id="informacionEstadoPais{{$paises->id}}"  style="text-align: center; font-size: 16px; display: none; "><span class="fa fa-exclamation-triangle"></span> Recuerde que al inactivar el país también inactivara todos los grupos asociados a este.</label>
                </div>
                <div id="btnActualizar" class="form-group">
                    <button type="submit" class="btn btn-success">Actualizar</button>
                </div>
                {!! Form::hidden('id',$paises->id)!!}
                {!! Form::close()!!}
            </div>
        </div>
    </div>
</div>