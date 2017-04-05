<?php use App\Http\Controllers\FallaController;?>
<div class="modal fade" id="verFallaEntregable{{$Proceso -> id}}" role="dialog">
    <div class="modal-content" role="document" id="modalVerTodo">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Falla proceso {{$Proceso -> nombre}}</h4>
            </div>
            <div class="modal-body">
                <div class="table-hover">

                    @if($Proceso->FK_Turno=="Noche")
                        <?php $falla= FallaController::buscarFallaNoche($Proceso->id) ?>
                    @endif
                    @if($Proceso->FK_Turno!="Noche")
                            <?php $falla= FallaController::buscarFalla($Proceso->id) ?>
                    @endif
                    <table class="table table-striped table-bordered table-hover table-responsive" align="center">
                        <thead>
                        <tr>
                            <th>Número caso</th>
                            <th>Descripción</th>
                            <th>Tipo</th>
                            <th>Estado</th>
                            @foreach($falla as $infoFalla)
                                @if($infoFalla->estado=='Solucionada')
                                    <th>Solución</th>
                                @endif
                            @endforeach
                            <th>Registro</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($falla as $infoFalla)
                        <tr>
                            <td>{{$infoFalla->n_caso}}</td>
                            <td>{{$infoFalla->descripcion}}</td>
                            <td>{{$infoFalla->tipo}}</td>
                            <td>{{$infoFalla->estado}}</td>
                            @if($infoFalla->estado=='Solucionada')
                                <td>{{$infoFalla->solucion}}</td>
                            @endif
                            <td>{{$infoFalla->registro}}</td>
                        </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>