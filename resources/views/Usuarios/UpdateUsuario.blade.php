<div class="modal fade" id="editarResponsable{{$responsable->id}}" role="dialog">
    <div class="modal-content" role="dialog" id="modalEntregable">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div id="icono">
                    <i class="fa fa-pencil"></i>
                    <h4 class="modal-title">Editar responsable {{$responsable->name}} {{$responsable->lastname}}</h4>
                </div>
            </div>
            <div class="modal-body">

                {!! Form::model($responsable, ['action' => ['UsuarioController@actualizarUsuario'], 'style' => 'margin-left: 30px;margin-top: 20px;'])!!}

                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="identificacion">Identificación:</label>
                                <div  class="col-md-8">
                                    {!! Form:: text('identificacion',null, ['class' => 'form-control', 'required' => 'required','tabindex'=>1,'id'=>"identificacion{$responsable->id}"])!!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="name">Nombre:</label>
                                <div  class="col-md-9">
                                    {!! Form:: text('name',null, ['class' => 'form-control', 'required' => 'required','tabindex'=>2,'id'=>"nombre{$responsable->id}"])!!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="lastname">Apellidos:</label>
                                <div  class="col-md-9">
                                    {!! Form:: text('lastname',null, ['class' => 'form-control', 'required' => 'required','tabindex'=>3,'id'=>"apellidos{$responsable->id}"])!!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="user_red">Usuario de red:</label>
                                <div  class="col-md-7" style="margin-top: 15px;">
                                    {!! Form:: text('user_red',null, ['class' => 'form-control', 'required' => 'required','tabindex'=>4,'id'=>"user_red{$responsable->id}"])!!}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form:: label('Tipo','Grupo:',['class' => 'col-md-4 control-label'])!!}
                                <div class="col-md-7">
                                    {!!Form :: select('Tipo', $tipos,  null, ['class' => 'form-control', 'tabindex'=>5,'id'=>"tipo{$responsable->id}"])!!}
                                </div>
                            </div>

                            <div class="form-group">

                                <label class="col-md-4 control-label" for="precontra">¿Cambiar contraseña?</label>
                                <div class="col-md-8" style="margin-top: 12px">
                                    <select id="precontra{{$responsable->id}}" name="precontra{{$responsable->id}}" class="form-control" onchange="validarCambio(this.value)" tabindex="6">
                                        <option selected="true" disabled="true">--Seleccione -- </option>
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>

                            <div id="contra{{$responsable->id}}" class="form-group" style="display:none" >
                                <label class="col-md-4 control-label" for="contrasenaEResponsable">Contraseña:</label>
                                <div class="col-md-7">
                                    <input type="password" id="contrasenaEResponsable{{$responsable->id}}" name="contrasenaEResponsable{{$responsable->id}}" class="form-control input-md" tabindex="7">
                                </div>
                            </div>

                            <div id="confcontra{{$responsable->id}}" class="form-group" style="display: none;">
                                <label class="col-md-4 control-label" for="confcontrasenaEResponsable">Confirme contraseña:</label>
                                <div class="col-md-7" style="margin-top: 12px">
                                    <input type="password" id="confcontrasenaEResponsable" name="confcontrasenaEResponsable" class="form-control input-md" tabindex="8">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="btnActualizar" class="form-group">
                        <button class="btn btn-success" id="btnActualizarFalla" onclick="ajaxActualizarUsuario()"> Actualizar</button>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" id="id{{$responsable->id}}" value="{{$responsable->id}}">
                {!! Form::close()!!}
            </div>
        </div>
    </div>
</div>
