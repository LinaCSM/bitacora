<div class="modal fade" id="registrarPais" role="dialog" style="overflow-y: auto">
    <div class="modal-content" role="dialog" id="modalTipo2">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div id="icono">
                    <i class="fa fa-file"></i>
                    <h4 class="modal-title">Registrar país</h4>
                </div>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'Pais.store', 'method'=> 'post', 'novalidate','style'=>'margin-left: 40px;margin-right: 20px;'])!!}
                <div class="form-group">
                    {!! Form:: label('nombre',"Nombre:",['class' => 'col-md-4 control-label'])!!}
                    <div  class="col-md-8">
                        {!! Form:: text('nombre',null, ['class' => 'form-control', 'required' => 'required','id'=> 'nombrePais'])!!}
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