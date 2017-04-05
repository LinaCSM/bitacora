<div class="modal fade" id="registrarSLA" role="dialog" style="overflow-y: auto">
    <div class="modal-content" role="dialog" id="modalTipo2">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div id="icono">
                    <i class="fa fa-file"></i>
                    <h4 class="modal-title">Registrar SLA</h4>
                </div>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'SLA.store', 'method'=> 'post', 'novalidate','style'=>'margin-left: 30px;'])!!}
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="porcentaje">Porcentaje:</label>
                            <div  class="col-md-8">
                                <input type="number" class="form-control input-md" id="porcentaje" name="porcentaje" tabindex="1" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="h_atraso">Hora atraso:</label>
                            <div  class="col-md-8" style="margin-top: 12px">
                                <input type="text" class="form-control input-md" id="h_atraso" name="h_atraso" tabindex="2" />
                            </div>
                        </div>
                    </div>
                <div class="form-group" style="float: right; margin-top: 40px;">
                    <button class="btn btn-success" type="submit" onclick="ajaxRegistrarSLA()"> Registrar</button>
                </div>

                {!! Form::close()!!}
            </div>
        </div>
    </div>
</div>