<?php use App\Http\Controllers\Controller;?>

<div class="modal fade" id="editarTurnos{{$turno->id}}" role="dialog">
    <div class="modal-content" role="dialog" id="modalTipo1" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div id="icono">
                    <i class="fa fa-pencil"></i>
                    <h4 class="modal-title">Editar turno {{$turno->nombre}}</h4>
                </div>
            </div>
            <?php $estado= Controller::getEnumValues('turnos','estado')?>
            <div class="modal-body">
                {!! Form::model($turno, ['action' => ['TurnoController@actualizarTurno'],'style'=>'margin-left: 30px;margin-top: 10px;'])!!}
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form:: label('nombre','Nombre:',['class' => 'col-md-4 control-label'])!!}
                                <div class="col-md-7">
                                    {!! Form:: text('nombre', null, ['class' => 'form-control input-md', 'tabindex'=>1,'id'=>"nombre{$turno->id}"])!!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="horaInicio" >Hora Inicio: </label>
                                <div class="col-md-7" style="margin-top: 15px">
                                    <input type='text' class="form-control" id='horaInicioTurnoE{{$turno->id}}' value="{{$turno->hora_inicio}}" tabindex="2" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="horaFinalTurnoE" >Hora Final: </label>
                                <div class="col-md-7" style="margin-top: 15px">
                                    <input type='text' class="form-control" id='horaFinalTurnoE{{$turno->id}}' value="{{$turno->hora_final}}" tabindex="3" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form:: label('estado','Estado:',['class' => 'col-md-3 control-label'])!!}
                                <div class="col-md-7">
                                    {!!Form :: select('estado',$estado, null, ['class' => 'form-control', 'tabindex'=>4,'id'=>"estado{$turno->id}",'onchange'=>'validarCambioEstado(this.value)'])!!}
                                </div>
                            </div>

                            <div id="justificacionEstadoTurno{{$turno->id}}" class="form-group" style="display: none">
                                {!! Form:: label('justificacion',"Justificación:",['class' => 'col-md-4 control-label'])!!}
                                <div class="col-md-8">
                                    {!!Form::textarea ('justificacion','', ['class'=>'form-control', 'rows' =>2, 'cols'=>25,'tabindex'=>3,'id'=>"justificacion{$turno->id}"])!!}
                                </div>
                            </div>
                            <div>
                                <label class="control-label" id="informacionEstado{{$turno->id}}" style="text-align: center; font-size: 16px; display: none; "><span class="fa fa-exclamation-triangle"></span> Recuerde que al inactivar el turno también inactivara todos los procesos asociados a este.</label>
                            </div>
                        </div>
                    </div>

                <div id="btnActualizar" class="form-group">
                    <button class="btn btn-success" onclick="ajaxActualizarTurno()" type="submit"> Actualizar</button>
                    <button class="btn btn-danger" data-dismiss="modal"> Cancelar</button>
                </div>

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" id="idTurno{{$turno->id}}" name="idTurno" value="{{$turno->id}}">
                {!! Form::close()!!}
            </div>
        </div>
    </div>
</div>