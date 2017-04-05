<?php use App\Http\Controllers\Controller;?>
<div class="modal fade" id="editarEntregable{{$Entregable->id}}" role="dialog">
    <div class="modal-content" role="dialog" id="modalEntregable">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div id="icono">
                    <i class="fa fa-pencil"></i>
                    <h4 class="modal-title">Editar entregable de {{$Entregable->Proceso}}</h4>
                </div>
            </div>
            <?php $entregables= Controller::getEnumValues('entregables','tipo')?>
            <div class="modal-body">
                {!! Form::model($Entregable, ['method' => 'PATCH', 'action' => ['EntregableController@update', $Entregable->id], 'files' => true,'style'=>'margin-left: 30px;margin-top: 20px;'])!!}
                    <div class="col-md-12">
                        <div class="col-md-7">
                            <div class="form-group">
                                {!! Form:: label('idP','Proceso:',['class' => 'col-md-2 control-label'])!!}
                                <div class="col-md-10">
                                    {!!Form :: select('idP',$procesos, null, ['class' => 'form-control', 'tabindex'=>1,'onchange'=>'ajaxBuscarProceso(this.value)'])!!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form:: label('tipo','Tipo:',['class' => 'col-md-2 control-label'])!!}
                                <div class="col-md-10">
                                    {!!Form :: select('tipo',$entregables, null, ['class' => 'form-control', 'tabindex'=>2])!!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form:: label('ruta','Ruta:',['class' => 'col-md-2 control-label'])!!}
                                <div class="col-md-10" >
                                    {!!Form::textarea ('ruta',null, ['class'=>'form-control', 'rows' =>3, 'cols'=>25,'tabindex'=>3])!!}
                                </div>
                            </div>

                        </div>
                        <div class="col-md-5">


                            <div class="form-group">
                                <label class="col-md-3 control-label" for="sysdate">Sysdate: </label>
                                <div class="col-md-7">
                                    <input type="text" id="sysdate{{$Entregable->id}}" name="sysdate" value="{{$Entregable->sysdate}}" class="form-control input-md" tabindex="4" disabled>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-6 control-label" for="horaEntrega">Hora entrega: </label>
                                <div class="col-md-6">
                                    <input type="text" id="horaEntrega{{$Entregable->id}}" name="horaEntrega" value="{{$Entregable->hora_aproximada}}" class="form-control input-md" tabindex="5" disabled style="margin-left: -25px;">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 control-label" for="responsable">Responsable: </label>
                                <div class="col-md-6">
                                    <input type="text" id="responsable{{$Entregable->id}}" name="responsable"  value="{{$Entregable->Responsable}}" class="form-control input-md" tabindex="6" disabled="">
                                </div>
                            </div>
                        </div>
                    </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" id="asignacion" name="asignacion" value="{{$Entregable->Asignacion}}">
                <input type="hidden" id="entregable" name="entregable" value="{{$Entregable->id}}">
                    <div id="btnActualizar" class="form-group">
                        <button class="btn btn-success" type="submit"> Actualizar</button>
                        <button class="btn btn-danger" data-dismiss="modal"> Cancelar</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>