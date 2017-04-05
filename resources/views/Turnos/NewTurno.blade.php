<div class="modal fade" id="registrarTurno" role="dialog">
    <div class="modal-content" role="dialog" id="modalTipo2">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div id="icono">
                    <i class="fa fa-file"></i>
                    <h4 class="modal-title">Registrar turno</h4>
                </div>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'Turno.store', 'method'=> 'post', 'novalidate','style'=>'margin-left: 30px;margin-top: 10px;'])!!}
                    <div class="col-md-12">

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="nombreTurno">Nombre: </label>
                                <div class="col-md-9">
                                    <input type="text" id="nombre" name="nombre" class="form-control input-md" tabindex="1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-5 control-label" for="horaInicioTurno">Hora Inicio: </label>
                                <div class="col-md-7" >
                                    <input type='text' class="form-control" id='horaInicioTurno' tabindex="3"/>
                                </div>
                            </div>

                        <div class="form-group">
                            <label class="col-md-5 control-label" for="horaFinalTurno">Hora Final: </label>
                            <div class="col-md-7" >
                                <input type='text' class="form-control" id='horaFinalTurno' tabindex="3"/>
                            </div>
                        </div>

                        <div class="form-group" style="float: right; margin-top: 30px;">
                            <button class="btn btn-success" type="submit" onclick="ajaxRegistrarTurno()"> Registrar</button>
                        </div>
                    </div>
                {!! Form::close()!!}
            </div>
        </div>
    </div>
</div>