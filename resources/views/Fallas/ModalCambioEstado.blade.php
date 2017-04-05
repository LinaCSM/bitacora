<div class="modal fade" id="cambiarEstadoFalla{{$Falla->id}}" role="dialog">
    <div class="modal-content" role="dialog" id="modalTipo2">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div id="icono">
                    <i class="fa fa-refresh"></i>
                    <h4 class="modal-title">Cambiar estado falla {{$Falla->job}}</h4>
                </div>
            </div>
            <div class="modal-body">
                {!! Form::model($Falla, ['action' => ['FallaController@actualizarEstado']])!!}
                    <div style="margin-left: 50px; margin-top:10px; margin-right:30px">
                        <div class="form-group">
                            {!! Form:: label('estado','Estado:',['class' => 'col-md-3 control-label'])!!}
                            <div class="col-md-8">
                                {!!Form :: select('estado', ['En espera'=>'En espera', 'Solucionada'=>'Solucionada'], null, ['class' => 'form-control', 'tabindex'=>1,'onchange'=>'validarEstadoFalla(this.value)','id'=>"estadoFalla{$Falla->id}"])!!}
                            </div>
                        </div>

                        <div id="solucionFalla{{$Falla->id}}" class="form-group" style="display: none;">
                            <label class="col-md-3 control-label" for="solucion" >Solución:</label>
                            <div class="col-md-8">
                                <textarea class="form-control" id="solucion{{$Falla->id}}" name="solucion{{$Falla->id}}" rows="2" cols="25" tabindex="2"></textarea>
                            </div>
                        </div>

                        <input type="hidden" id="idF{{$Falla->id}}" value="{{$Falla->id}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    </div>
            </div>
            <div class="modal-footer">
                <div class="form-group" style="float: right; margin-right: 15px;margin-top: 10px;">
                    <button id="btnCambiar" onclick="ajaxCambiarEstadoFalla()" class="btn btn-success">Cambiar</button>
                    <button class="btn btn-danger" data-dismiss="modal"> Cancelar</button>
                </div>
            </div>

            {!! Form::close()!!}
        </div>
    </div>
</div>