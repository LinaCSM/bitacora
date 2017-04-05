<div class="modal fade" id="registrarResponsable" role="dialog">
    <div class="modal-content" role="dialog" id="modalEntregable">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div id="icono">
                    <i class="fa fa-file"></i>
                    <h4 class="modal-title">Registrar responsable</h4>
                </div>
            </div>
            <div class="modal-body">
                {!! Form::open(['action' => ['UsuarioController@store'],'class'=>'form-inline','style'=>'margin-left: 30px;margin-top: 20px;'])!!}
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="identificacion">Identificación:</label>
                                <div class="col-md-8">
                                    <input type="text" id="identificacion" name="identificacion" class="form-control input-md" tabindex="1">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="nombre">Nombre:</label>
                                <div class="col-md-9">
                                    <input type="text" id="nombre" name="nombre" class="form-control input-md" tabindex="2">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="apellido">Apellidos:</label>
                                <div class="col-md-9">
                                    <input type="text" id="apellido" name="apellido" class="form-control input-md" tabindex="3">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 control-label" for="usuarioRed">Usuario red:</label>
                                <div class="col-md-7">
                                    <input type="text" id="usuarioRed" name="usuarioRed" class="form-control input-md" tabindex="4">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="tipo">Grupo:</label>
                                <div class="col-md-9">
                                    <select id="tipo" name="tipo" class="form-control" tabindex="5">
                                        <option selected="true" disabled="true">--Seleccione un grupo--</option>
                                        @foreach($tipo as $Tipo)
                                            <option value="{{$Tipo->id}}">{{$Tipo->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="contrasena">Contraseña:</label>
                                <div class="col-md-7">
                                    <input type="password" id="contrasena" name="contrasena" class="form-control input-md" tabindex="6">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="confcontrasena">Confirme contraseña:</label>
                                <div class="col-md-7" style="margin-top: 12px">
                                    <input type="password" id="confcontrasena" name="confcontrasena" class="form-control input-md" tabindex="7">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="float: right;margin-top: 10px;">
                        <button class="btn btn-success" type="submit"> Registrar</button>
                    </div>
                {!! Form::close()!!}
            </div>
        </div>
    </div>
</div>