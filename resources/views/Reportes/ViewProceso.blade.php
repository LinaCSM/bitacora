<?php use App\Http\Controllers\SLAController;?>

<div class="modal fade" id="verProceso{{$Semaforo->idP}}" tabindex="-1" role="dialog" >
    <div class="modal-content" role="document" id="modalVerTodo">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Proceso {{$Semaforo->nombre}}</h4>
            </div>
            <?php $sla = SLAController::buscarSLA($Semaforo->idP)?>
            <div class="modal-body">
                <div class="table-hover">
                    <table class="table table-striped table-bordered table-hover table-responsive" align="center">
                        <thead>
                        <tr>
                            <th>Turno</th>
                            <th>Job</th>
                            <th>Servidor</th>
                            <th>Catálogo</th>
                            <th>Grupo</th>
                            <th>País</th>
                            @foreach($sla as $PSLA)
                                @if($PSLA->porcentaje<="75" && $PSLA->justificacion_SLA!="")
                                    <th>Justificacion SLA</th>
                                @endif
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$Semaforo->turno}}</td>
                            <td>{{$Semaforo->job}}</td>
                            <td>{{$Semaforo->servidor}}</td>
                            <td>{{$Semaforo->catalogo}}</td>
                            <td>{{$Semaforo->grupo}}</td>
                            <td>{{$Semaforo->pais}}</td>
                            @foreach($sla as $PSLA)
                                @if($PSLA->porcentaje<="75" && $PSLA->justificacion_SLA!="")
                                    <td>{{$PSLA-> justificacion_SLA}}</td>
                                @endif
                            @endforeach
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>