<?php use App\Http\Controllers\FallaController;?>
<div class="modal fade" id="verFalla{{$Falla -> id}}" role="dialog">
    <div class="modal-content" role="document" id="modalVerTodo">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Falla proceso {{$Falla -> nombre}}</h4>
            </div>
            <div class="modal-body">
                <div class="table-hover">

                    <?php $fallaEntrega=FallaController::buscarEntregaFalla($Falla->idP,$Falla->fechaPF)?>
                    <table class="table table-striped table-bordered table-hover table-responsive" align="center">
                        <thead>
                        <tr>
                            <th>Turno</th>
                            <th>Plataforma</th>
                            <th>Frecuencia</th>
                            <th>Dias ejecucion</th>
                            @if($Falla->estado=="Solucionada")
                                <th>Solucion falla</th>
                            @endif
                            <th>¿Proceso relanzado?</th>
                            <th>Registro</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$Falla->FK_Turno}}</td>
                            <td>{{$Falla->plataforma}}</td>
                            <td>{{$Falla->FK_Frecuencia}}</td>
                            <td>{{$Falla->DiaEjecucion}}</td>
                            @if($Falla->estado=="Solucionada")
                                <td>{{$Falla->solucion}}</td>
                            @endif
                            <td>{{$Falla->r_proceso}}</td>
                            @foreach($fallaEntrega as $entregaF)
                            <td>{{$entregaF->registro}}</td>
                                @endforeach
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>