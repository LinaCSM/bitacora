<?php use App\Http\Controllers\Controller;?>

<div class="modal fade" id="editarSLA{{$SLAS->id}}" role="dialog" style="overflow-y: auto">
    <div class="modal-content" role="dialog" id="modalTipo2">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div id="icono">
                    <i class="fa fa-pencil"></i>
                    <h4 class="modal-title">Editar SLA {{$SLAS->porcentaje}}</h4>
                </div>
                <label class="control-label" style="text-align: center; font-size: 16px;  ">
                    <span class="fa fa-exclamation-triangle" ></span> Importante: Editar cualquier dato del SLA tiene como consecuencia que los datos del semáforo no se generen (modificar código).</label>
            </div>
            <?php $estado= Controller::getEnumValues('sla','estado')?>
            <div class="modal-body">
                {!! Form::model($SLAS, ['action' => ['SLAController@actualizarSLA' ,'style'=>'margin-left: 30px;margin-top: 10px;']])!!}
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form:: label('porcentaje','Porcentaje:',['class' => 'col-md-4 control-label','style'=>'text-align:right;'])!!}
                            <div class="col-md-7">
                                {!! Form:: number('porcentaje', null, ['class' => 'form-control input-md', 'tabindex'=>1,'id'=>"porcentaje{$SLAS->id}"])!!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="h_atrasoE" style="text-align:right;">Hora atraso:</label>
                            <div class="col-md-8" style="margin-top: 12px">
                                <input type="text" class="form-control input-md" id="h_atrasoE{{$SLAS->id}}" name="h_atrasoE{{$SLAS->id}}"
                                       value="{{$SLAS->hora_atraso}}" tabindex="2"/>
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form:: label('estado','Estado:',['class' => 'col-md-4 control-label','style'=>'text-align:right;'])!!}
                            <div class="col-md-8">
                                {!!Form :: select('estado',$estado, null, ['class' => 'form-control', 'tabindex'=>3,'id'=>"estado{$SLAS->id}",'onchange'=>'validarCambioEstadoSLA(this.value)'])!!}
                            </div>
                        </div>

                        <div id="justificacionEstadoSLA{{$SLAS->id}}" class="form-group" style="display: none">
                            {!! Form:: label('justificacion',"Justificación:",['class' => 'col-md-4 control-label'])!!}
                            <div class="col-md-8">
                                {!!Form::textarea ('justificacion','', ['class'=>'form-control', 'rows' =>2, 'cols'=>25,'tabindex'=>3,'id'=>"justificacion{$SLAS->id}",])!!}
                            </div>
                        </div>

                        <div id="btnActualizar" class="form-group">
                            <button class="btn btn-success" id="btnActualizarFalla" onclick="ajaxActualizarSLA()"> Actualizar</button>
                        </div>
                    </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" id="idSLA{{$SLAS->id}}" name="idSLA" value="{{$SLAS->id}}">
                {!! Form::close()!!}
            </div>
        </div>
    </div>
</div>