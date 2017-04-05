<?php use App\Http\Controllers\ProcesoController;?>
<div class="modal fade" id="editarCargue{{$Cargue->id}}" role="dialog">
    <div class="modal-content" role="dialog" id="mEditarC">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div id="icono">
                    <i class="fa fa-pencil"></i>
                    <h4 class="modal-title">Editar {{$Cargue->nombre}}</h4>
                </div>
            </div>
            <div class="modal-body">
                {!! Form::model($Cargue, ['action' => ['CargueController@actualizarCargue'],'class'=>'form-inline editproceso-form','style'=>' margin-left: 40px;'])!!}
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form:: label('nombre','Nombre:',['class' => 'col-md-3 control-label'])!!}
                                <div class="col-md-9">
                                    {!!Form::textarea ('nombre',null, ['class'=>'form-control', 'rows' =>1, 'cols'=>34,'tabindex'=>1,'id'=>"nombre{$Cargue->id}"])!!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form:: label('ruta','Ruta:',['class' => 'col-md-2 control-label'])!!}
                                <div class="col-md-10">
                                    {!!Form::textarea ('ruta',null, ['class'=>'form-control', 'rows' =>2, 'cols'=>36,'tabindex'=>2,'id'=>"ruta{$Cargue->id}"])!!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form:: label('job','Job:',['class' => 'col-md-2 control-label'])!!}
                                <div class="col-md-10">
                                    {!!Form::textarea ('job',null, ['class'=>'form-control', 'rows' =>1, 'cols'=>36,'tabindex'=>3,'id'=>"job{$Cargue->id}"])!!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form:: label('ruta','Tarea:',['class' => 'col-md-2 control-label'])!!}
                                <div class="col-md-10">
                                    {!!Form::textarea ('tarea',null, ['class'=>'form-control', 'rows' =>1, 'cols'=>36,'tabindex'=>4,'id'=>"tarea{$Cargue->id}"])!!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form:: label('tipo_archivo','Tipo archivo:',['class' => 'col-md-3 control-label'])!!}
                                <div class="col-md-6"  style="margin-top: 12px;">
                                    {!! Form:: text('tipo_archivo', null, ['class' => 'form-control input-md', 'tabindex'=>5,'id'=>"archivo{$Cargue->id}"])!!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form:: label('bd','Base de datos:',['class' => 'col-md-3 control-label'])!!}
                                <div class="col-md-6" style="margin-top: 12px;">
                                    {!! Form:: text('bd', null, ['class' => 'form-control input-md', 'tabindex'=>6,'id'=>"bd{$Cargue->id}"])!!}
                                </div>
                            </div>

                            <div class="form-group is-empty">
                                <label class="col-md-3 control-label" for="horaEjecucion">Hora ejecución: </label>
                                <div class="col-md-6" style="margin-top: 15px">
                                    <input type="text" id="horaEjecucion{{$Cargue->id}}" name="horaEjecucion{{$Cargue->id}}" class="form-control"  value="{{$Cargue -> hora_ejecucion}}" tabindex="7">
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form:: label('periodicidad','Periodicidad:',['class' => 'col-md-4 control-label'])!!}
                                <div class="col-md-8">
                                    {!!Form::textarea ('periodicidad',null, ['class'=>'form-control', 'rows' =>1, 'cols'=>20,'tabindex'=>8,'id'=>"periodicidad{$Cargue->id}"])!!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form:: label('Pais','Pais:',['class' => 'col-md-3 control-label'])!!}
                                <div class="col-md-9">
                                    {!!Form :: select('FK_Pais',$paises, null, ['class' => 'form-control', 'tabindex'=>9,'onchange'=>'ajaxBPais(this.value)'])!!}
                                </div>
                            </div>

                            <?php $grupo=ProcesoController::buscarGrupos($Cargue->FK_Pais)?>

                            <div class="form-group">
                                {!! Form:: label('FK_Grupo','Grupo:',['class' => 'col-md-4 control-label'])!!}
                                <div class="col-md-8">
                                    {!!Form :: select('FK_Grupo', $grupo, null, ['class' => 'form-control', 'tabindex'=>10,'id'=>"grupo{$Cargue->id}"])!!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form:: label('plataforma','Plataforma:',['class' => 'col-md-5 control-label'])!!}
                                <div class="col-md-6">
                                    {!!Form :: select('plataforma', ['Oracle'=>'Oracle', 'Netezza'=>'Netezza'], null, ['class' => 'form-control', 'tabindex'=>11,'id'=>"plataforma{$Cargue->id}"])!!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form:: label('FK_Tipo','Responsable:',['class' => 'col-md-5 control-label'])!!}
                                <div class="col-md-7">
                                    {!!Form :: select('FK_Tipo', $tipos,  null, ['class' => 'form-control', 'tabindex'=>12,'id'=>"tipo{$Cargue->id}"])!!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form:: label('servidor','Servidor:',['class' => 'col-md-3 control-label'])!!}
                                <div class="col-md-8">
                                    {!!Form::textarea ('servidor',null, ['class'=>'form-control', 'rows' =>1, 'cols'=>20,'tabindex'=>13,'id'=>"servidor{$Cargue->id}"])!!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form:: label('catalogo','Catálogo:',['class' => 'col-md-3 control-label'])!!}
                                <div class="col-md-8">
                                    {!!Form::textarea ('catalogo',null, ['class'=>'form-control', 'rows' =>1, 'cols'=>20,'tabindex'=>14,'id'=>"catalogo{$Cargue->id}"])!!}
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="id{{$Cargue->id}}" value="{{$Cargue->id}}">
                        <input type="hidden" id="cargueGrupo{{$Cargue->id}}" value="{{$Cargue->idCG}}">
                    </div>
                    <div id="btnActualizar" class="form-group">
                        <button class="btn btn-success" onclick="ajaxActualizarCargue()"> Actualizar</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>