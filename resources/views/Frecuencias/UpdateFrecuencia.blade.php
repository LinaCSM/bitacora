<?php use App\Http\Controllers\Controller;?>
<div class="modal fade" id="editarFrecuencia{{$frecuencias->id}}" role="dialog" style="overflow-y: auto">
    <div class="modal-content" role="dialog" id="modalTipo2">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div id="icono">
                    <i class="fa fa-pencil"></i>
                    <h4 class="modal-title">Editar frecuencia {{$frecuencias->nombre}}</h4>
                </div>
            </div>
            <?php $estado= Controller::getEnumValues('frecuencias','estado')?>
            <div class="modal-body">
                {!! Form::model($frecuencias, ['method' => 'PATCH', 'action' => ['FrecuenciaController@update', $frecuencias->id], 'files' => true,'style'=>'margin-left:40px'])!!}
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
                            {!!Form :: select ("estado", $estado, null, ['class' => 'form-control','onchange'=>'validarCambioEstadoFrecuencia(this.value)','tabindex'=>4])!!}
                        </div>
                    </div>

                    <div id="justificacionEstadoFrecuencia{{$frecuencias->id}}" class="form-group" style="display: none">
                        {!! Form:: label('justificacion',"Justificación:",['class' => 'col-md-4 control-label'])!!}
                        <div class="col-md-8">
                            {!!Form::textarea ('justificacion','', ['class'=>'form-control', 'rows' =>2, 'cols'=>25,'tabindex'=>3])!!}
                        </div>
                    </div>
                </div>
                <div>
                    <label class="control-label" id="informacionEstadoFrecuencia{{$frecuencias->id}}" style="text-align: center; font-size: 16px; display: none; "><span class="fa fa-exclamation-triangle"></span> Recuerde que al inactivar la frecuencia también inactivara todos los procesos asociados a esta.</label>
                </div>
            </div>
            <div class="modal-footer">
                <div id="btnActualizar" class="form-group">
                    <button class="btn btn-success"  style="margin-right: 10px"> Actualizar</button>
                </div>
            </div>

            {!! Form::hidden('id',$frecuencias->id)!!}
            {!! Form::close()!!}
        </div>
    </div>
</div>