<?php use App\Http\Controllers\MinutogramaController;?>
<?php use App\Http\Controllers\ProcesoController;?>
<div class="modal fade" id="editarProceso{{$Proceso -> id}}" role="dialog">
    <div class="modal-content" role="dialog" id="mEditarC">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div id="icono">
                    <i class="fa fa-pencil"></i>
                    <h4 class="modal-title">Editar proceso {{$Proceso -> nombre}}</h4>
                </div>
            </div>
            <div class="modal-body">

                {!! Form::model($Proceso, ['action' => ['ProcesoController@actualizarProceso'],'class'=>'form-inline editproceso-form','style'=>'margin-top:10px'])!!}

                <fieldset>
                    <div style="margin-left: 100px">
                        <div class="col-md-6">

                            <div class="form-group">
                                {!! Form:: label('nombre','Nombre:',['class' => 'col-md-3 control-label'])!!}
                                <div class="col-md-9">
                                    {!!Form::textarea ('nombre',null, ['class'=>'form-control', 'rows' =>2, 'cols'=>34,'tabindex'=>1,'id'=>"nombre{$Proceso->id}"])!!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form:: label('job','Job:',['class' => 'col-md-3 control-label'])!!}
                                <div class="col-md-9">
                                    {!!Form::textarea ('job',null,  ['class'=>'form-control', 'rows' =>2, 'cols'=>27,'tabindex'=>2,'id'=>"job{$Proceso->id}"])!!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form:: label('tarea_programada','Tarea:',['class' => 'col-md-3 control-label'])!!}
                                <div class="col-md-9">
                                    {!!Form::textarea ('tarea_programada',null,  ['class'=>'form-control', 'rows' =>2, 'cols'=>26,'tabindex'=>3,'id'=>"t_programada{$Proceso->id}"])!!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form:: label('prerequisitos','Pre-requisito:',['class' => 'col-md-3 control-label'])!!}
                                <div class="col-md-9">
                                    {!!Form::textarea ('prerequisitos',null,  ['class'=>'form-control', 'rows' =>2, 'cols'=>20,'tabindex'=>4,'id'=>"prerequisito{$Proceso->id}"])!!}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                {!! Form:: label('FK_Pais','País:',['class' => 'col-md-3 control-label'])!!}
                                <div class="col-md-9">
                                    {!!Form :: select('FK_Pais',$paises, null, ['class' => 'form-control', 'tabindex'=>5,'id'=>"pais{$Proceso->id}",'onchange'=>'ajaxBPais(this.value)'])!!}
                                </div>
                            </div>

                            <?php $grupo=ProcesoController::buscarGrupos($Proceso->FK_Pais)?>

                            <div class="form-group">
                                {!! Form:: label('FK_Grupo','Grupo:',['class' => 'col-md-4 control-label'])!!}
                                <div class="col-md-8">
                                    {!!Form :: select('FK_Grupo', $grupo, null, ['class' => 'form-control', 'tabindex'=>6,'id'=>"grupo{$Proceso->id}"])!!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form:: label('sysdate','Sysdate:',['class' => 'col-md-3 control-label'])!!}
                                <div class="col-md-6">
                                    {!! Form:: text('sysdate', null, ['class' => 'form-control input-md', 'tabindex'=>7,'id'=>"sysdate{$Proceso->id}"])!!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form:: label('servidor','Servidor:',['class' => 'col-md-3 control-label'])!!}
                                <div class="col-md-7">
                                    {!!Form::textarea ('servidor',null, ['class'=>'form-control', 'rows' =>1, 'cols'=>25,'tabindex'=>8,'id'=>"servidor{$Proceso->id}"])!!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form:: label('catalogo','Catálogo:',['class' => 'col-md-3 control-label'])!!}
                                <div class="col-md-7">
                                    {!!Form::textarea ('catalogo',null, ['class'=>'form-control', 'rows' =>1, 'cols'=>25,'tabindex'=>9,'id'=>"catalogo{$Proceso->id}"])!!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form:: label('plataforma','Plataforma:',['class' => 'col-md-5 control-label'])!!}
                                <div class="col-md-7">
                                    {!!Form :: select('plataforma', ['Oracle'=>'Oracle', 'Netezza'=>'Netezza'], null, ['class' => 'form-control', 'tabindex'=>10,'id'=>"plataforma{$Proceso->id}"])!!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="float: right; margin-right: 15px;margin-top: 10px;">
                            <button type="button" class="btn btn-success btn-next">Siguiente</button>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="fieldset2">
                    <div style="margin-left: 100px">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form:: label('FK_Turno','Turno:',['class' => 'col-md-4 control-label'])!!}
                                <div class="col-md-8">
                                    {!!Form :: select('FK_Turno', $turnos, null, ['class' => 'form-control', 'tabindex'=>11,'id'=>"turno{$Proceso->id}"])!!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="h_ejecucionE">Horario: </label>
                                <div class="col-md-7">
                                    <input type="text" id="h_ejecucionE{{$Proceso->id}}" name="h_ejecucionE{{$Proceso->id}}" class="form-control input-md" value="{{$Proceso -> horario}}" tabindex="12">
                                </div>
                            </div>

                            <div class="form-group is-empty">
                                <label class="col-md-3 control-label" for="t_ejecucionE">Tiempo ejecución: </label>
                                <div class="col-md-6" style="margin-top: 15px">
                                    <input type="text" id="t_ejecucionE{{$Proceso->id}}" name="t_ejecucionE{{$Proceso->id}}" class="form-control"  value="{{$Proceso -> t_ejecucion}}" tabindex="13" >
                                </div>
                            </div>


                            <div class="form-group">
                                {!! Form:: label('semaforo','¿Pertenece al semaforo?',['class' => 'col-md-6 control-label'])!!}
                                <div class="col-md-6" style="margin-left: -8px;margin-top: 15px;">
                                    {!!Form :: select('semaforo', ['Si'=>'Si','No'=>'No'], null, ['class' => 'form-control', 'tabindex'=>14,'id'=>"semaforo{$Proceso->id}"])!!}
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                {!! Form:: label('FK_Frecuencia','Frecuencia:',['class' => 'col-md-5 control-label'])!!}
                                <div class="col-md-7">
                                    {!!Form :: select('FK_Frecuencia', $frecuencias, null, ['class' => 'form-control', 'tabindex'=>15,'onchange'=>'validarFrecuenciaEdit(this.value)','id'=>"FrecuenciaFK{$Proceso->id}"])!!}
                                </div>
                            </div>

                            <?php $busquedaDias = MinutogramaController::buscarDiasEjecucion($Proceso->id)?>
                            <div class="form-group" id="diasFrecuencia">
                                <label class="col-md-4 control-label" for="diasE">Dias ejecución: </label>
                                <div class="col-md-8" style="margin-top: 12px; margin-left:-12px">
                                    <textarea class="form-control" id="diasE{{$Proceso->id}}" name="diasE" rows="1" tabindex="10" cols="15" disabled>@foreach($busquedaDias as $dias){{$dias->Dia}} @endforeach</textarea>
                                </div>
                            </div>

                            <input type="hidden" id="frecuencia{{$Proceso->id}}" value="{{$Proceso->Frecuencia}}">

                            <input type="hidden" id="diasEjecucion{{$Proceso->id}}"
                                   value="@foreach($busquedaDias as $dias){{$dias->Dia}} @endforeach">

                            <div class="form-group">
                                {!! Form:: label('FK_Tipo','Responsable:',['class' => 'col-md-5 control-label'])!!}
                                <div class="col-md-7">
                                    {!!Form :: select('FK_Tipo', $tipos,  null, ['class' => 'form-control', 'tabindex'=>17,'id'=>"tipo{$Proceso->id}"])!!}
                                </div>
                            </div>

                            @if($Proceso->justificacion!="" && $Proceso->estado!="Activo")
                                <div class="form-group">
                                    {!! Form:: label('justificacion',"Justificación estado ".$Proceso->estado.":",['class' => 'col-md-4 control-label'])!!}
                                    <div class="col-md-7" style="margin-top: 15px;">
                                        {!!Form::textarea ('justificacion',null, ['class'=>'form-control', 'rows' =>2, 'cols'=>25,'tabindex'=>18,'id'=>"justificacion{$Proceso->id}"])!!}
                                    </div>
                                </div>

                            @endif

                        </div>
                    </div>
                    <div class="form-group" style="float: right; margin-right: 15px;margin-top: 60px;">
                        <button type="button" class="btn btn-previous">Anterior</button>
                        <button type="submit" class="btn btn-success" onclick="ajaxActualizarProceso()">Actualizar</button>
                    </div>
                </fieldset>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" id="id{{$Proceso->id}}" value="{{$Proceso->id}}">
                <input type="hidden" id="tamano{{$Proceso->id}}">
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>