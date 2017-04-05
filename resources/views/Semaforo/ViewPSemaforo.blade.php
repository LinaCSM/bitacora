<?php use App\Http\Controllers\MinutogramaController;
use App\Http\Controllers\SLAController;?>

<div class="modal fade" id="verSemaforoP{{$Proceso -> id}}" role="dialog">
    <div class="modal-content" role="document" id="modalVerTodo">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Proceso {{$Proceso -> job}}</h4>
            </div>
            <?php $busquedaDias = MinutogramaController::buscarDiasEjecucion($Proceso->id)?>
            <?php $busquedaEntregables = MinutogramaController::buscarEntregables($Proceso->id)?>

            @if($Proceso->FK_Turno=="Noche")
                <?php $busquedaEntregas = MinutogramaController::buscarEntregaNoche($Proceso->id)?>
            @endif

            @if($Proceso->FK_Turno!="Noche")
                <?php $busquedaEntregas = MinutogramaController::buscarEntrega($Proceso->id)?>
            @endif
            <?php $sla = SLAController::buscarSLA($Proceso->id)?>

            <div class="modal-body">
                <table class="table table-striped table-bordered table-hover table-responsive" align="center">
                    <thead>
                    <tr>
                        <th>Plataforma</th>
                        <th>Entregable</th>
                        <th>Dias ejecucion</th>
                        @foreach($sla as $PSLA)
                            @if($PSLA->porcentaje<="75" && $PSLA->justificacion_SLA!="")
                                <th>Justificacion SLA</th>
                            @endif
                        @endforeach
                            @if($busquedaEntregas!="[]")
                                <th>Registrado por</th>
                                <th>Fecha entrega</th>
                            @endif
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{$Proceso -> plataforma}}</td>
                        <td>
                        @foreach($busquedaEntregables as $entregables)
                             {{$entregables->Tipo}}<br>
                        @endforeach
                        </td>
                        @foreach($busquedaDias as $dias)
                            <td>{{$dias->Dia}}</td>
                        @endforeach
                        @foreach($sla as $PSLA)
                            @if($PSLA->porcentaje<="75" && $PSLA->justificacion_SLA!="")
                                <td>{{$PSLA-> justificacion_SLA}}</td>
                            @endif
                        @endforeach
                        @if($busquedaEntregas!="[]")
                            @foreach($busquedaEntregas as $entrega)
                                <td>{{$entrega-> registro}}</td>
                                <td>{{$entrega-> fecha}}</td>
                            @endforeach
                        @endif
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
