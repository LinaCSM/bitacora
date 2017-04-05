<?php use App\Http\Controllers\Controller;?>
<div class="modal fade" id="registrarGrupo" role="dialog" style="overflow-y: auto">
    <div class="modal-content" role="dialog" id="modalTipo3">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div id="icono">
                    <i class="fa fa-file"></i>
                    <h4 class="modal-title">Registrar grupo</h4>
                </div>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'Grupo.store', 'method'=> 'post', 'novalidate','style'=>'margin-left:30px'])!!}
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="pais">Pais: </label>
                            <div class="col-md-7">
                                <select id="pais" name="pais" class="form-control" tabindex="4">
                                    <option selected="true" disabled="true">--Seleccione pais--</option>
                                    @foreach($pais as $Pais)
                                        <option value="{{$Pais->id}}">{{$Pais->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form:: label('nombre',"Nombre:",['class' => 'col-md-3 control-label'])!!}
                            <div  class="col-md-7">
                                {!! Form:: text('nombre',null, ['class' => 'form-control', 'required' => 'required','tabindex'=>1])!!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form:: label('descripcion',"Descripción:",['class' => 'col-md-3 control-label'])!!}
                            <div class="col-md-7">
                                {!!Form::textarea ('descripcion',null, ['class'=>'form-control', 'rows' =>2, 'cols'=>30,'tabindex'=>2])!!}
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="form-group" style="float: right;margin-right: 20px;">
                    <button class="btn btn-success"> Registrar</button>
                </div>
            </div>
            {!! Form::close()!!}
        </div>
    </div>
</div>