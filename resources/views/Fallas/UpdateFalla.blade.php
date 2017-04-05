<div class="modal fade" id="editarFalla{{$Falla->id}}" role="dialog" style="overflow-y: auto" >
    <div class="modal-content" role="dialog" id="modalTipo1">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div id="icono">
                    <i class="fa fa-pencil"></i>
                    <h4 class="modal-title">Editar falla {{$Falla->job}}</h4>
                </div>
            </div>
            <div class="modal-body">
                {!! Form::model($Falla, ['method' => 'PATCH', 'action' => ['FallaController@update', $Falla->id], 'files' => true,'style'=>'margin-left: 20px;margin-top: 20px;margin-right: 20px;'])!!}
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form:: label('fecha','Fecha:',['class' => 'col-md-3  control-label'])!!}
                                <div class="col-md-9">
                                    {!! Form:: text ('fecha', null, ['class' => 'form-control input-md','tabindex'=>'1','disabled'])!!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form:: label('n_caso','N° caso:',['class' => 'col-md-4  control-label'])!!}
                                <div class="col-md-8">
                                    {!! Form:: text ('n_caso', null, ['class' => 'form-control input-md','tabindex'=>'2'])!!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form:: label('descripcion','Descripción falla:',['class' => 'col-md-4  control-label'])!!}
                                <div class="col-md-8">
                                    {!!Form::textarea ('descripcion',null, ['class'=>'form-control', 'rows' =>2, 'cols'=>30,'tabindex'=> '3'])!!}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                {!! Form:: label('tipo','Tipo:',['class' => 'col-md-3  control-label'])!!}
                                <div class="col-md-9">
                                    {!!Form :: select ('tipo', ['Endogena'=>'Endogena', 'Exogena'=>'Exogena'], null, ['class' => 'form-control','tabindex'=>'4'])!!}
                                </div>
                            </div>

                            @if($Falla->estado=="Solucionada")
                            <div class="form-group">
                                {!! Form:: label('solucion','Solución falla:',['class' => 'col-md-4  control-label'])!!}
                                <div class="col-md-8">
                                    {!!Form::textarea ('solucion',null, ['class'=>'form-control', 'rows' =>2, 'cols'=>30,'tabindex'=> '5'])!!}
                                </div>
                            </div>
                            @endif

                            <div class="form-group">
                                {!! Form:: label('r_proceso','¿Se relanza el proceso?',['class' => 'col-md-5  control-label'])!!}
                                <div class="col-md-7">
                                    {!!Form :: select ('r_proceso', ['Si'=>'Si', 'No'=>'No'], null, ['class' => 'form-control','tabindex'=>'6','style'=>'margin-top:10px','onchange'=>'validarCambioReproceso(this.value)'])!!}
                                </div>
                            </div>

                            <div>
                                <label class="control-label" id="informacionEstadoSi{{$Falla->Pid}}" style="text-align: center; font-size: 16px; display: none;"><span class="fa fa-exclamation-triangle"></span> Recuerde que al seleccionar la opción "Si" el proceso pasara automáticamente a Exitoso</label>
                                <label class="control-label" id="informacionEstadoNo{{$Falla->Pid}}" style="text-align: center; font-size: 16px; display: none;"><span class="fa fa-exclamation-triangle"></span> Recuerde que al seleccionar la opción "No" el proceso pasara automáticamente a Fallido</label>
                            </div>
                        </div>
                        {!! Form::hidden('Pid', null)!!}
                        {!! Form::hidden('id',null)!!}
                        {!! Form::hidden('idE',null)!!}
                    </div>

            </div>
            <div class="modal-footer">
                <div id="btnActualizar" class="form-group" style="float: right; margin-right: 55px;margin-top: 10px;">
                    <button class="btn btn-success" id="btnActualizarFalla" type="submit"> Actualizar</button>
                    <button class="btn btn-danger" data-dismiss="modal"> Cancelar</button>
                </div>
            </div>
            {!! Form::close()!!}
        </div>
    </div>
</div>