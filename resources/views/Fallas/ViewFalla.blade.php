<?php use App\Http\Controllers\MinutogramaController;?>
<div class="modal fade" id="verFalla{{$Falla -> id}}" role="dialog">
    <div class="modal-content" role="document" id="modalVerTodo">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Falla proceso {{$Falla -> nombre}}</h4>
            </div>
            <div class="modal-body">
                <div class="table-hover">
                    <?php $busquedaDias = MinutogramaController::buscarDiasEjecucion($Falla->Pid)?>
                    <table class="table table-striped table-bordered table-hover table-responsive" align="center">
                        <thead>
                        <tr>
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
                            <td>{{$Falla->plataforma}}</td>
                            <td>{{$Falla->FK_Frecuencia}}</td>
                            <td>
                                @foreach($busquedaDias as $dias)
                                    {{$dias->Dia}}<br>
                                @endforeach
                            </td>
                            @if($Falla->estado=="Solucionada")
                                <td>{{$Falla->solucion}}</td>
                            @endif
                            <td>{{$Falla->r_proceso}}</td>
                            <td>{{$Falla->registro}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>